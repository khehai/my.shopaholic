<?php 
namespace Controllers\Admin;

use Controllers\Admin\AdminController;

class DashboardController extends AdminController
{
    protected static string $layout = 'admin';
    
    public function index()
    {
        $this->response->render('/admin/index');
    } 

}