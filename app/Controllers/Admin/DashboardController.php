<?php 
namespace Controllers\Admin;

use Core\Controller;


class DashboardController extends Controller
{
    protected static string $layout = 'admin';
    
    public function index()
    {
        $this->response->render('/admin/index');
    } 

} 