<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guestChildOrders extends Model
{
     public $fillable = ['visitorId','orderId','productId','productName','productSummary','productQuantity','productPrice','productImage'];
}
