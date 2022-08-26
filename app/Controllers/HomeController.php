<?php
namespace App\Controllers;

// require_once ROOT.'/core/Controller.php';

use Core\Controller;

class HomeController extends Controller
{
    protected static string $layout = 'app';
    public function index()
     {
          $this->response->render ('/home/index');
    }
}
//  require_once realpath(ROOT.'/app/Views/home/index.php');  

    