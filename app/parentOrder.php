<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parentOrder extends Model
{
    protected $primaryKey = 'orderId'; // or null

    public $incrementing = false;
    
    public $fillable = ['orderId','custId','noOfUnits','amount','orderStatus'];
}
