<?php
namespace Controllers;

use Core\Controller;

use Models\{Brand, Category, Product};

class ShopController extends Controller
{
    protected static string $layout = 'app';

    public function index(){
        $this->response->render('shop/index');
    }
}
    