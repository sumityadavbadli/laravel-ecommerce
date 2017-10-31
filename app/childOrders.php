<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class childOrders extends Model
{
        public $fillable = ['custId','orderId','productId','productName','productSummary','productQuantity','productPrice','productImage'];
}
