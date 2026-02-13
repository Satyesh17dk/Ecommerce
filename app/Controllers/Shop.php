<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductImageModel;

class Shop extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        $products = $productModel->findAll();

        foreach ($products as &$product) {
            $product['images'] = $imageModel
                ->where('product_id', $product['id'])
                ->findAll();
        }

        return view('shop', ['products' => $products]);
    }
}
