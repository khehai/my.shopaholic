<?php
return [
    '' => 'HomeController@index',
    'shop' => 'ShopController@index',
    'contact' => 'ContactController@index',
    'admin' => 'Admin\DashboardController@index',
    'admin/brands' => 'Admin\BrandController@index',
    'admin/brands/create' => 'Admin\BrandController@create',
    'admin/brands/edit/{id}' => 'Admin\BrandController@edit',
    'admin/brands/destroy/{id}' => 'Admin\BrandController@destroy',
    'admin/brands/update' => 'Admin\BrandController@update',
    'admin/brands/store' => 'Admin\BrandController@store',
    'errors' => 'ErrorController@index',
];

