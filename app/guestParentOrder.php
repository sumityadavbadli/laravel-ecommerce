<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class guestParentOrder extends Model
{
    protected $primaryKey = 'orderId'; // or null

    public $incrementing = false;
    
    public $fillable = ['orderId','visitorId','noOfUnits','amount','orderStatus'];
}
