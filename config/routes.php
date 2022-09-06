<?php
return [
    '' => 'Controllers\HomeController@index',
    'shop' => 'Controllers\ShopController@index',
    'contact' => 'Controllers\ContactController@index',

    'api/products' => 'Controllers\HomeController@getProduct',

    'admin' => 'Controllers\Admin\DashboardController@index',
    'admin/brands' => 'Controllers\Admin\BrandController@index',
    'admin/brands/create' => 'Controllers\Admin\BrandController@create',
    'admin/brands/edit/{id}' => 'Controllers\Admin\BrandController@edit',
    'admin/brands/destroy/{id}' => 'Controllers\Admin\BrandController@destroy',
    'admin/brands/update' => 'Controllers\Admin\BrandController@update',
    'admin/brands/store' => 'Controllers\Admin\BrandController@store',

    'admin/badges' => 'Controllers\Admin\BadgeController@index',
    'admin/badges/create' => 'Controllers\Admin\BadgeController@create',
    'admin/badges/edit/{id}' => 'Controllers\Admin\BadgeController@edit',
    'admin/badges/destroy/{id}' => 'Controllers\Admin\BadgeController@destroy',
    'admin/badges/update' => 'Controllers\Admin\BadgeController@update',
    'admin/badges/store' => 'Controllers\Admin\BadgeController@store',

    'admin/products' => 'Controllers\Admin\ProductController@index',
    'admin/products/create' => 'Controllers\Admin\ProductController@create',
    'admin/products/edit/{id}' => 'Controllers\Admin\ProductController@edit',
    'admin/products/destroy/{id}' => 'Controllers\Admin\ProductController@destroy',
    'admin/products/update' => 'Controllers\Admin\ProductController@update',
    'admin/products/store' => 'Controllers\Admin\ProductController@store',


    'admin/categories' => 'Controllers\Admin\CategoryController@index',
    'admin/categories/create' => 'Controllers\Admin\CategoryController@create',
    'admin/categories/edit/{id}' => 'Controllers\Admin\CategoryController@edit',
    'admin/categories/destroy/{id}' => 'Controllers\Admin\CategoryController@destroy',
    'admin/categories/update' => 'Controllers\Admin\CategoryController@update',
    'admin/categories/store' => 'Controllers\Admin\CategoryController@store',

    'errors' => 'Controllers\ErrorController@index',
];

