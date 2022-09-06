<?php 
namespace Controllers\Admin;

use Core\Controller;

use Models\Badge;

class BadgeController extends Controller
{
    protected static string $layout = 'admin';
    private Badge $badge;
    
    public function __construct()
    {
        parent::__construct();
        $this->badge = new Badge();
    }

    public function index()
    {
        // $brands = $this->brand->get();
        $badges = $this->badge->get();
        // var_dump($brands);
        $this->response->render('/admin/badges/index', compact('badges'));
    } 

    public function create()
    {
        $this->response->render('/admin/badges/create');
    }

    public function store()
    {
        $this->badge->title = $this->request->title;
        $this->badge->bg = $this->request->bg;
        
        if($this->badge->save()){
            $this->response->redirect('/admin/badges');
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

