<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'order_id',
        'payment_gateway',
        'transaction_id',
        'amount',
        'status',
        'response'
    ];
}
