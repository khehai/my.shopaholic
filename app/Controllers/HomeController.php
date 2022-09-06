<?php
namespace Controllers;

use Models\Product;

use Core\Controller;

class HomeController extends Controller
{
    protected static string $layout = 'app';
    public function index()
    {
        $this->response->render('/home/index');
    } 

    public function getProduct()
    {
        // $products = (new Product())->select(["products.*", "badges.title as badgeTitle", "badges.bg"])->join('badges')->on('badge_id')->get();
        $products = (new Product())->select(["products.*", "badges.title as
         badgeTitle", "badges.bg", "categories.name", "categories.id as categoryId", "brands.name as brandName", "brands.id as brandId"])->mjoin(['badges'=>'badge_id', 'brands'=>'brand_id', 'categories'=>'category_id'])->get();
        echo json_encode($products);
    }
}
