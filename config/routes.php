<?php
return array(

    'admin/main' => 'admin/main',
    'admin/addProduct' => 'admin/addProduct',
    'admin/products' => 'admin/products',
    'admin/product/edit/([0-9]+)' => 'admin/editProduct/$1',
    'admin/ajaxCategory' => 'admin/ajaxCategory',
    'admin/product/delete/([0-9]+)' => 'admin/deleteProduct/$1',

    'catalog/([a-z]+)' => 'catalog/catalog/$1',

    'category/([a-z]+)/([a-z]+)/page-([0-9]+)/([a-z]+)' => 'catalog/category/$1/$2/$3/$4',
    'category/([a-z]+)/([a-z]+)/page-([0-9]+)' => 'catalog/category/$1/$2/$3',
    'category/([a-z]+)/([a-z]+)' => 'catalog/category/$1/$2',  //CatalogController and actionCategory


    'cart/add' => 'cart/add',
    'cart/ajaxCity' => 'cart/ajaxCity',
    'cart/ajaxWarehouse' => 'cart/ajaxWarehouse',
    'cart/confirm' => 'cart/confirm',
    'cart/delete' => 'cart/deleteCart', 
    'cart/unset/([0-9]+)' => 'cart/deleteFromCart/$1', 
    'cart' => 'cart/cart', //CartController and actionCart

    'search/([a-z]+)' => 'site/search/$1',
    'search' => 'site/search',

    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/profile' => 'user/profile',
    'user/register' => 'user/register',
    
    'product/([0-9]+)' => 'product/view/$1', //ProductController and actionView
    
    '' => 'site/index',
);