<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\CartModel;
use App\Models\ProductModel;
use App\Models\OrderModel;

class CartApi extends ResourceController
{
    protected $cartModel;
    protected $productModel;
    protected $userId = 1; // Hardcoded as required

    public function __construct()
    {
        $this->cartModel    = new CartModel();
        $this->productModel = new ProductModel();
    }

    /*
    -----------------------------------------
    1️⃣ ADD TO CART (POST)
    -----------------------------------------
    */
public function add()
{
    $userId = 1;

    $productId = $this->request->getPost('product_id');
    $quantity  = $this->request->getPost('quantity') ?? 1;

    // Check product exists
    $product = $this->productModel->find($productId);

    if (!$product) {
        return redirect()->back();
    }

    // Check if already in cart
    $existing = $this->cartModel
        ->where('user_id', $userId)
        ->where('product_id', $productId)
        ->first();

    if ($existing) {

        $this->cartModel->update($existing['id'], [
            'quantity' => $existing['quantity'] + $quantity
        ]);

    } else {

        $this->cartModel->insert([
            'user_id'    => $userId,
            'product_id' => $productId,
            'quantity'   => $quantity,
            'price'      => $product['price']
        ]);
    }

    // 🔥 CALCULATE TOTAL CART COUNT FROM DATABASE
    $totalQty = $this->cartModel
        ->where('user_id', $userId)
        ->selectSum('quantity')
        ->first()['quantity'] ?? 0;

    session()->set('cart_count', $totalQty);

    return redirect()->back();
}


    /*
    -----------------------------------------
    2️⃣ CART LIST (GET)
    -----------------------------------------
    */
    public function index()
    {
        $items = $this->cartModel
            ->select('carts.*, products.name')
            ->join('products', 'products.id = carts.product_id')
            ->where('user_id', $this->userId)
            ->findAll();

        $total = 0;

        foreach ($items as &$item) {
            $item['subtotal'] = $item['price'] * $item['quantity'];
            $total += $item['subtotal'];
        }

        return $this->respond([
            'status' => true,
            'cart_items' => $items,
            'cart_total' => $total
        ]);
    }

    /*
    -----------------------------------------
    3️⃣ UPDATE CART ITEM
    -----------------------------------------
    */
    // public function update($id = null)
    // {
    //     $quantity = $this->request->getPost('quantity');

    //     if (!$quantity) {
    //         return $this->fail('Quantity required');
    //     }

    //     $this->cartModel->update($id, [
    //         'quantity' => $quantity
    //     ]);

    //     return $this->respond([
    //         'status' => true,
    //         'message' => 'Cart updated successfully'
    //     ]);
    // }

    public function update($id = null)
{
    $quantity = $this->request->getPost('quantity');

    if (!$quantity) {
        return redirect()->to(base_url('cart'));
    }

    $this->cartModel->update($id, [
        'quantity' => $quantity
    ]);

    $totalQty = $this->cartModel
        ->where('user_id', $this->userId)
        ->selectSum('quantity')
        ->first()['quantity'] ?? 0;

    session()->set('cart_count', $totalQty);

    return redirect()->to(base_url('cart'));
}


    /*
    -----------------------------------------
    4️⃣ DELETE CART ITEM
    -----------------------------------------
    */
    // public function delete($id = null)
    // {
    //     $this->cartModel->delete($id);

    //     return $this->respond([
    //         'status' => true,
    //         'message' => 'Item removed from cart'
    //     ]);
    // }

    public function delete($id = null)
{
    $this->cartModel->delete($id);

    // Recalculate cart count
    $totalQty = $this->cartModel
        ->where('user_id', $this->userId)
        ->selectSum('quantity')
        ->first()['quantity'] ?? 0;

    session()->set('cart_count', $totalQty);

    return redirect()->to(base_url('cart'));
}


    public function checkout()
{
    $userId = 1;

    $cartModel      = new \App\Models\CartModel();
    $orderModel     = new \App\Models\OrderModel();
    $orderItemModel = new \App\Models\OrderItemModel();
    $paymentModel   = new \App\Models\PaymentModel();

    $cartItems = $cartModel->where('user_id', $userId)->findAll();

    if (empty($cartItems)) {
        return $this->respond([
            'status' => false,
            'message' => 'Cart is empty'
        ]);
    }

    // Calculate total
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // 1️⃣ Create Order
    $orderId = $orderModel->insert([
        'user_id' => $userId,
        'total_amount' => $totalAmount,
        'payment_status' => 'pending',
        'order_status' => 'placed'
    ]);

    // 2️⃣ Insert Order Items
    foreach ($cartItems as $item) {
        $orderItemModel->insert([
            'order_id' => $orderId,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'subtotal' => $item['price'] * $item['quantity']
        ]);
    }

    // 3️⃣ Create Payment Entry (Pending)
    $paymentModel->insert([
        'order_id' => $orderId,
        'payment_gateway' => 'Razorpay',
        'amount' => $totalAmount,
        'status' => 'pending'
    ]);

    // 4️⃣ Clear Cart
    $cartModel->where('user_id', $userId)->delete();

    return $this->respond([
        'status' => true,
        'message' => 'Order created successfully',
        'order_id' => $orderId,
        'amount' => $totalAmount
    ]);
}

}
