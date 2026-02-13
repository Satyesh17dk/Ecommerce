<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class CartPage extends BaseController
{
    public function index()
    {
        $cartModel = new CartModel();
        $productModel = new ProductModel();

        $cartItems = $cartModel->where('user_id',1)->findAll();

        foreach ($cartItems as &$item) {
            $product = $productModel->find($item['product_id']);
            $item['name']  = $product['name'];
            $item['price'] = $product['price'];
            $item['total'] = $product['price'] * $item['quantity'];
        }

        return view('cart', ['items' => $cartItems]);
    }
}
