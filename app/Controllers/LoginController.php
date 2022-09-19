<?php
namespace Controllers;

use Core\{Controller, Session};
use Models\{User, Seance};


class LoginController extends Controller
{
    protected static string $layout = 'app';

    //a string holding the cookie prefix
	private $cookie_name = 'auth_session_cookie';
    
    private $site_key = 'this_is_site_key';
    
    public const HASH_LENGTH = 40;
    
    public $isAuth = false;
    
    protected User $user;

    protected $user_id;

    protected Seance $seance;

    public function __construct()
	{
        parent::__construct();

        $this->user = new User();
        $this->seance = new Seance();

        //  if (!empty($this->config->site_timezone)) {
        //     date_default_timezone_set($this->config->site_timezone);
        // }

        [$this->isAuth, $this->user_id] = $this->isLogged();
    }

    public function isLogged():array
    {
        if ($this->isAuth === false) {
            [$this->isAuth, $uid] = $this->checkSession($this->getCurrentSessionHash());
        } 
        return [$this->isAuth, $uid ?? null];
    }

    public function getCurrentSessionHash():string
    {
        return $_COOKIE[$this->cookie_name] ?? '';
    }

    public function checkSession(string $hash):array
    {
        if (strlen($hash) != self::HASH_LENGTH) {
            return [false, null];
        }
        $condition = "hash='$hash'";
        $seance = $this->seance->findBy($condition);

        $uid = $seance->uid;

        $expire_date = strtotime($seance->expiredate);
        $current_date = strtotime(date('Y-m-d H:i:s'));

        $db_cookie = $seance->cookie_crc;

        if ($current_date > $expire_date) {
            $this->deleteSession($hash);
            return [false, null];
        }

        if ($db_cookie == sha1($hash . $this->site_key)) {
            return [true, $uid];
        }

        return [false, null];
    }


    protected function addSession(int $uid, bool $remember)
    {
        // $user = $this->getBaseUser($uid);
        $user = $this->user->first($uid);
        if (!$user) {
            return false;
        }

        $cookie_remember = time() + 60 * 60 * 24;
        $cookie_forget = time() - 60 * 60 * 24;

        $this->seance->uid = $uid;
        $this->seance->hash = sha1($this->site_key . microtime());
        $this->seance->agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
                
        // $expire
        //     = $remember
        //     ? $this->cookie_remember
        //     : $this->cookie_forget;

        $this->seance->cookie_crc = sha1($this->seance->hash . $this->site_key);
        $this->seance->expiredate = date('Y-m-d H:i:s', $cookie_remember);
        
        $this->seance->save();
        
        setcookie($this->cookie_name, $this->seance->hash, $cookie_remember);
        
        return $this->seance;
    }

    public function getUID(string $email):int
    {
        $condition = "email='$email'";
        $uid = (new User)->find($condition, ['id']);
        return $uid === false ? 0 : $uid->id;
    }

    /**
     * @return bool
     */
    function signin()
    {
        $uid = $this->getUID($this->request->email); 
        
        if (!$uid) {
            $this->request->flash()->danger('Email address or password are incorrect.');
            $this->response->back();
        }
        
        $user = $this->user->first($uid);

        if (!password_verify($this->request->password, $user->password)) {

            $this->request->flash()->danger('Email address or password are incorrect.');
            $this->response->back();
        }
        
        $remember = $this->request->remember ? 1 : 0;
        
        $sessiondata = $this->addSession($user->id, $remember);

        if (!$sessiondata) {
            $this->request->flash()->danger('A system error has been encountered. Please try again.');
            $this->response->back();
        }
        Session::instance()->set('userId', $user->id);
        Session::instance()->set('isAuth', true);

        // var_dump($this->request->session()->get('isAuth'));
        // exit;
        $this->response->redirect("/profile");
    }

    public function logout():bool
    {
        $hash = $this->getCurrentSessionHash();

        if (strlen($hash) != self::HASH_LENGTH) {
            return false;
        }
        $this->isAuth = false;
        $this->user_id = null;
        Session::instance()->unset('userId');
        Session::instance()->unset('isAuth');

        $this->deleteSession($hash);
        $this->response->redirect('/');    
    }

    protected function deleteSession(string $hash):bool
    {
        $this->removeCookie();
        return $this->seance->delete("hash = '$hash'") == 1;
    }

    /**
     * Clear user cookie
     */
    protected function removeCookie():bool
    {
        if(isset($_COOKIE[$this->cookie_name])) {
            unset($_COOKIE[$this->cookie_name]);
        }

        if (!setcookie($this->cookie_name, '', -1, '/')) {
            return false;
        }

        return true;
    }
    
    public function index()
    {
        if ($this->isAuth) {
            $this->response->redirect('/profile');    
        } else {
            $this->response->render('auth/login');    
        }
    }

}