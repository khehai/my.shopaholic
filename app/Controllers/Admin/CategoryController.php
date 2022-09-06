<?php 
namespace Controllers\Admin;

use Core\Controller;

use Models\Category;
use Core\Traits\{Resizer, Uploader};

class CategoryController extends Controller
{
    use Resizer, Uploader;

    protected static string $layout = 'admin';
    private Category $category;
    
    public function __construct()
    {
        parent::__construct();
        $this->category = new Category();
    }

    public function index()
    {
        $categories = $this->category->get();
        $this->response->render('/admin/categories/index', compact('categories'));
    } 

    public function create()
    {
        $this->response->render('/admin/categories/create');
    }

    public function store()
    {
        // var_dump($this->request);
        // exit;
        $this->category->name = $this->request->name;
        $this->category->status = $this->request->status ? 1 : 0;
        
        $obj = $this->load($this->request->cover['tmp_name']);
        $img = $this->resize_width(200, $obj);

        $this->category->cover = $this->upload($img, "/categories/", $obj->type, 75);

        if($this->category->save()){
            $this->response->redirect('/admin/categories');
        }else{
            $this->response->redirect('/errors');
        }
    }

    public function edit($params)
    {
        extract($params);

        $category = $this->category->first($id);
        $this->response->render('/admin/categories/edit', compact('category'));
    }
    public function update()
    {
        $this->category->id = $this->request->id;
        $this->category->name = $this->request->name;
        $this->category->description = $this->request->description;
        
        if($this->category->save()){
            $this->response->redirect('/admin/categories');
        }else{
            $this->response->redirect('/errors');
        }
    }
    public function destroy($params)
    {
        extract($params);
        if ($_POST) {
            if($this->category->delete($this->request->id)){
                $this->response->redirect('/admin/categories');
            }else{
                $this->response->redirect('/errors');
            } 
        }

    }
}