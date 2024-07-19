<?php

namespace controllers\products;

use models\Product;

class ProductController{
    public function index(){

        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $productModel = new Product;
            $products = $productModel->getAllProducts();
            include('app/views/products/index.php');
        }else{
            http_response_code(403);
            exit();
        }
    }

    public function store(){
        $productModel = new Product;
        $productModel->add($_POST);
        header('Location: /products');
    }

    public function update($params){
        $productModel = new Product;
        $id = $params['id'];
        $productModel->update($_POST,$id);
        header('Location: /products');
    }

    public function softDelete($params){
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']){
            $productModel = new Product;
            $data['soft_delete'] = 1;
            $id = $params['id'];
            $productModel->update($data,$id);
            header('Location: /products');
        }else{
            http_response_code(403);
            exit();
        }
    }
}