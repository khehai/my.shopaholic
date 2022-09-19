<?php
namespace Controllers;

use Core\{Controller, Session};

use Models\{User};

class CartController extends Controller
{
    protected static string $layout = 'app';
    protected $user;

    public function __construct()
    {
        parent::__construct();
        $userId = Session::instance()->get('userId');
        if($userId) {
            Session::instance()->set('isAuth', true);
            $this->user = (new User)->first($userId);
        }
    }

    public function auth(){
        if($this->user){
            echo json_encode($this->user->id);
        }
    }

    public function index(){
        $this->response->render('/home/cart');
    }

}