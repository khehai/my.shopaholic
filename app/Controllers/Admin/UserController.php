<?php 
namespace Controllers\Admin;

use Core\Controller;

use Models\{User, Role};
use Core\Traits\Helpers;

class UserController extends Controller
{
    use Helpers;
    
    protected static string $layout = 'admin';
    private User $user;
    
    public function __construct()
    {
        parent::__construct();
        $this->user = new User();
    }

    public function index()
    {
        $users = $this->user->get();
       
        $this->response->render('/admin/users/index', compact('users'));
    } 

    public function create()
    {
        $roles = (new Role)->get();
        $this->response->render('/admin/users/create', compact('roles'));
    }

    public function store()
    {
        $this->user->name = $this->request->name;
        $this->user->email = $this->request->email;
        $this->user->role_id = $this->request->role_id;
        $this->user->status = $this->request->status ? 1 : 0;
        $this->user->password = $this->getHash($this->request->password, 12);
        try {
            $this->user->save();
            $this->request->flash()->message('success', 'User created Successfully!');
            $this->response->redirect('/admin/users');
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