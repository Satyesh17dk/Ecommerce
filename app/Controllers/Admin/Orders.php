<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PaymentModel;

class Orders extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();

        $orders = $orderModel->orderBy('id','DESC')->findAll();

        return view('admin/orders/index', ['orders' => $orders]);
    }

    public function view($id)
    {
        $orderModel = new OrderModel();
        $itemModel  = new OrderItemModel();
        $paymentModel = new PaymentModel();

        $order = $orderModel->find($id);

        $items = $itemModel
            ->select('order_items.*, products.name')
            ->join('products', 'products.id = order_items.product_id')
            ->where('order_id', $id)
            ->findAll();

        $payment = $paymentModel->where('order_id',$id)->first();

        return view('admin/orders/view', [
            'order' => $order,
            'items' => $items,
            'payment' => $payment
        ]);
    }
}
