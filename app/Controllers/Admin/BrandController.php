<?php 
namespace Controllers\Admin;

use Core\Controller;

use Models\Brand;

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
        try {
            $this->brand->save();
            $this->request->flash()->message('success', 'Brand created Successfully!');
            $this->response->redirect('/admin/brands');
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