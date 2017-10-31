<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class popularProducts extends Model
{
    protected $primaryKey = 'productId'; // or null
    
    public $incrementing = false;
    
    public $fillable = ['productId'];

    public function manageProducts()
    {
        return $this->belongsTo('App\manageProducts','productId','productId');
    }
}
