<?php
namespace Controllers;

use Core\Controller;

use Models\{Brand, Category, Product};

class HomeController extends Controller
{
    protected static string $layout = 'app';

    public function index(){
        $this->response->render('/home/index');
    }

    public function getProducts()
    {
        $products = (new Product)->get();
        echo json_encode($products);
    }

    public function getCategories()
    {
        $categories = (new Category)->get();
        echo json_encode($categories);
    }

    

    public function getProductsByCategory($params)
    {
        extract($params);
        $products = (new Product)->where("products.status = 1 and products.category_id=$id")->get();
        echo json_encode($products);
    }

    public function getAllProducts() {        
        // $products = (new Product)->select(["products.*", "categories.name", "categories.cover"])->join('categories')->on('category_id')->get();

        $products = (new Product())->select(["products.*", "badges.title as badgeTitle", "badges.bg", "categories.name as category", 
        "categories.id as categoryId", "brands.name as brandName", 
        "brands.id as brandId"])->mjoin(['badges'=>'badge_id', 'brands'=>'brand_id', 'categories'=>'category_id'])->get();        
    
        echo json_encode($products);

    }
}