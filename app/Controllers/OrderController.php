<?php
namespace Controllers;

use Core\{Controller, Session};

use Models\{User, Order};

class OrderController extends Controller
{
    protected static string $layout = 'app';
    protected $user;
    private Order $order;

    public function __construct()
    {
        parent::__construct();
        $userId = Session::instance()->get('userId');
        if($userId) {
            Session::instance()->set('isAuth', true);
            $this->user = (new User)->first($userId);
        }
        $this->isGranted();
        $this->order = new Order();

    }
    private function isGranted() {
        if(!$this->user) {
            $this->response->redirect('/login');
        }
        return true;
    }

    public function checkout() {
        if(strtoupper($_SERVER['REQUEST_METHOD']) != 'POST'){
            throw new \Exception('Only POST requests are allowed');
        }
        $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
        if(stripos($content_type, 'application/json') === false){
            throw new \Exception('Content-Type must be application/json');
        } else {
            $content = trim(file_get_contents("php://input"));
            $decode = json_decode($content, true);
            if (!is_array($decode)) {
                throw new \Exception('Failed to decode json object');
            }

            $products = json_encode($decode['cart']);
            try {
                $sql = "INSERT INTO orders (user_id, products) VALUES (?, ?)";
                $result = $this->order->insert($sql, [$this->user->id, $products]);
                $options = [
                    'error' => false,
                    'message' => 'Evertthing OK'
                ];
                echo json_encode($options);
            }catch(\Exception $e) {
                $options = [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
                echo json_encode($options);
            }
        }
    }

}