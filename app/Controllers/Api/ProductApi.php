<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductModel;
use App\Models\ProductImageModel;

class ProductApi extends ResourceController
{
    public function index()
    {
        $productModel = new ProductModel();
        $imageModel   = new ProductImageModel();

        $products = $productModel->where('status',1)->findAll();

        foreach ($products as &$product) {
            $product['images'] = $imageModel
                ->where('product_id', $product['id'])
                ->findAll();
        }

        return $this->respond([
            'status' => true,
            'products' => $products
        ]);
    }
}
