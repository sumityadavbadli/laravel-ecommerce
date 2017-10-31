<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productImages extends Model
{
    protected $primaryKey = 'imageId'; // or null
    public $incrementing = false;
}
