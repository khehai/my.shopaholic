<?php
namespace Controllers;

use Core\Controller;
use Models\User;
use Core\Traits\Helpers;

class RegisterController extends Controller
{
    use Helpers;

    protected static string $layout = 'app';
    private int $cost = 12;
    
    private User $user;

    public function __construct(){
        parent::__construct();
        $this->user = new User();
    }

    public function index()
    {
        
        $this->response->render('auth/register');
    }

    private function checkEmail(string $email)
    {
        $condition = "email='$email'";
        return (new User)->findBy($condition) ? true : false;
    }

    protected function validate_request($request):array
    {
        if (strlen($request->email) < 8) { //`aa@bb.cc`
            return [false, 'Your email address length too short. Please type carefully!'];
        } elseif (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) { 
            return [false, 'Your email address invalid. Please type carefully!'];
        } elseif (strlen($request->password) < 8){
            return [false, 'Your passwords length too short. Please type carefully!'];
        } elseif ($request->password != $request->confirmpassword) {
            return [false, 'Your passwords do not match. Please type carefully!'];
        }
       return [true, ''];
    }

    public function signup()
    {
        if($this->checkEmail($this->request->email)) { 
            $this->response->redirect('/login');
        } 
        [$state, $message] = $this->validate_request($this->request);

        if ($state) {
            
            $this->user->email = $this->request->email;
            
            $username = explode("@", $this->request->email)[0];
            
            $this->user->name = $username;
            $this->user->email = $this->request->email;
            
            $this->user->role_id = 2;
            $this->user->status = $this->request->status ? 1 : 0;
            $this->user->password = $this->getHash($this->request->password, $this->cost);
            
            $this->user->first_name = $this->request->first_name ?? $username;
            $this->user->last_name = $this->request->last_name ?? '';
            $this->user->phone_number = $this->request->phone_number ?? '';
            try {
                    $this->user->save(); 
                    $this->request->flash()->message('success', 'Your profile created successfully!');
                    $this->response->redirect('/login');
            } catch(\Exception $e){
                    $this->request->flash()->errors($e->getMessage());
                    $this->response->back();
            }
        }else {
            $this->request->flash()->danger($message);
            $this->response->back();
        }  
    }
}