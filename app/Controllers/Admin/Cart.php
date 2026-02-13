<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ProductModel;

class Cart extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        $cartModel = new CartModel();

        $cartItems = $cartModel
            ->select('carts.*, products.name, products.price')
            ->join('products', 'products.id = carts.product_id')
            ->where('carts.user_id', 1) // temporary fixed user
            ->findAll();

        return view('admin/cart/index', [
            'cartItems' => $cartItems
        ]);
    }

    public function update($id)
    {
        $cartModel = new CartModel();
        $quantity = $this->request->getPost('quantity');

        $cartModel->update($id, [
            'quantity' => $quantity
        ]);

        return redirect()->to('/admin/cart');
    }

    public function delete($id)
    {
        $cartModel = new CartModel();
        $cartModel->delete($id);

        return redirect()->to('/admin/cart');
    }
}
