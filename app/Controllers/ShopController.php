<?php
namespace Controllers;

// require_once ROOT.'/core/Controller.php';

use Core\Controller;

class ShopController extends Controller
{
    protected static string $layout = 'app';
    public function index()
     {
          $this->response->render ('/shop/index');
    }
}
//  require_once realpath(ROOT.'/app/Views/home/index.php');  

    