<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tempOrders extends Model
{
         public $fillable = ['userId','productId','productName','productSummary','productQuantity','productPrice','productImage'];
}
