<?php 
namespace Controllers\Admin;

use Core\Controller;

use Models\{Category, Brand, Badge, Product};
use Core\Traits\{Resizer, Uploader};

class ProductController extends Controller
{
    use Resizer, Uploader;

    protected static string $layout = 'admin';
    private Product $product;
    
    public function __construct()
    {
        parent::__construct();
        $this->product = new Product();
    }

    public function index()
    {
        $products = $this->product->get();
        $this->response->render('/admin/products/index', compact('products'));
    } 

    public function create()
    {
        $categories = (new Category())->get();
        $brands = (new Brand())->get();
        $badges = (new Badge())->get();
        $this->response->render('/admin/products/create', compact('categories', 'brands', 'badges'));
    }

    public function store()
    {
        // var_dump($this->request);
        // exit;
        $this->product->title = $this->request->title;
        $this->product->status = $this->request->status ? 1 : 0;
        $this->product->price = $this->request->price;
        $this->product->description = $this->request->description;
        $this->product->category_id = intval($this->request->category_id);
        $this->product->brand_id = intval($this->request->brand_id);
        $this->product->badge_id = intval($this->request->badge_id);

        $obj = $this->load($this->request->image['tmp_name']);
        $img = $this->resize_width(300, $obj);

        $this->product->image = $this->upload($img, "/products/", $obj->type, 75);

        if($this->product->save()){
            $this->response->redirect('/admin/products');
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