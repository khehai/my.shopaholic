<?php 
namespace App\Controllers\Admin;

use Core\Controller;

use App\Models\Brand;

class BrandController extends Controller
{
    protected static string $layout = 'admin';
    private Brand $brand;
    
    public function __construct()
    {
        parent::__construct();
        $this->brand = new Brand();
    }

    public function index()
    {
        // $brands = $this->brand->get();
        $brands = $this->brand->select(['id', 'name'])->get();
        // var_dump($brands);
        $this->response->render('/admin/brands/index', compact('brands'));
    } 

    public function create()
    {
        $this->response->render('/admin/brands/create');
    }

    public function store()
    {
        $this->brand->name = $this->request->name;
        $this->brand->description = $this->request->description;
        
        if($this->brand->save()){
            $this->response->redirect('/admin/brands');
        }else{
            $this->response->redirect('/errors');
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
                $this->response->redirect('/admin/brands');
            }else{
                $this->response->redirect('/errors');
            } 
        }

    }
}