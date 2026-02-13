<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\OrderModel;
use App\Models\PaymentModel;

class PaymentApi extends ResourceController
{
    public function success($orderId)
    {
        $orderModel   = new OrderModel();
        $paymentModel = new PaymentModel();

        $order = $orderModel->find($orderId);

        if (!$order) {
            return $this->respond([
                'status' => false,
                'message' => 'Order not found'
            ]);
        }

        // Generate fake transaction ID
        $transactionId = 'TXN' . time();

        // Update payment_details table
        $paymentModel
            ->where('order_id', $orderId)
            ->set([
                'status' => 'success',
                'transaction_id' => $transactionId
            ])
            ->update();

        // Update orders table
        $orderModel->update($orderId, [
            'payment_status' => 'paid',
            'order_status'   => 'processing'
        ]);

        return $this->respond([
            'status' => true,
            'message' => 'Payment marked as successful',
            'transaction_id' => $transactionId
        ]);
    }
}
