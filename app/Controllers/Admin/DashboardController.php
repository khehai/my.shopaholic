<?php 
namespace App\Controllers\Admin;

use Core\Controller;

require_once ROOT.'/core/Response.php';

class DashboardController extends Controller
{
    protected static string $layout = 'admin';
    
    public function index()
    {
        $this->response->render('/admin/index');
    } 

} 