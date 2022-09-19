<?php 
namespace Controllers\Admin;

use Core\Controller;

use Models\Role;

class RoleController extends Controller
{
    protected static string $layout = 'admin';
    private Role $role;
    
    public function __construct()
    {
        parent::__construct();
        $this->role = new Role();
    }

    public function index()
    {
        $roles = $this->role->get();
        $this->response->render('/admin/roles/index', compact('roles'));
    } 

    public function create()
    {
        $this->response->render('/admin/roles/create');
    }

    public function store()
    {
        $this->role->name = $this->request->name;
       
        try {
            $this->role->save();
            $this->request->flash()->message('success', 'Role created Successfully!');
            $this->response->redirect('/admin/roles');
        } catch(\Exception $e){
            $this->request->flash()->dander($e->getMessage());
            $this->response->back();
        }
        
    }

    public function edit($params)
    {
        extract($params);

        $brand = $this->brand->first($id);
        $this->response->render('/admin/brands/edit', compact('brand'));
    }
    public function update()
    {
        $this->brand->id = $this->request->id;
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;
        
        if($this->brand->save()){
            $this->request->flash()->message('success', 'Brand updated Successfully!');
            $this->response->redirect('/admin/brands');
        }else{
            $this->response->redirect('/errors');
        }
    }
    public function destroy($params)
    {
        extract($params);
        if ($_POST) {
            if($this->brand->delete($this->request->id)){
                $this->request->flash()->success('Brand Deleted Successfully!');
                $this->response->redirect('/admin/brands');
            }else{
                $this->response->redirect('/errors');
            } 
        }

    }
}