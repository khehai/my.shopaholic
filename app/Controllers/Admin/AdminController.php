<?php 
namespace Controllers\Admin;

use Core\{Session, Controller};
use Models\{User, Role};
use Core\AuthInterface;

class AdminController extends Controller implements AuthInterface
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $userId = Session::instance()->get('userId');

        if ($userId) {
            Session::instance()->set('isAuth', true);
            $this->user = (new User)->first($userId);
        }
        if (!$this->isGranted("admin")) {
            $this->response->redirect('/profile');
        }
    }
    public function role() {
        if ($this->user) {
            $role = (new Role)->first($this->user->role_id);
            return $role->name;
        }
    }
    
    public function isGranted(string $name):bool {
        return ($this->role() === $name) ?? false;
    }
    
    public function index()
    {
        $this->response->render('/admin/index');
    } 

}