<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerProfile extends Model
{
    protected $primaryKey = 'custId'; // or null
    
    public $incrementing = false;
    
    public $fillable = ['custId','firstName','lastName','email','altEmail','contact','altContact','address','street','pinCode','location','status'];

//    public function Customer()
//    {
//        return $this->belongsTo('App\Customer','custId','custId');
//    }
}
