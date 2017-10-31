<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manageCategory extends Model
{
    public $fillable = ['name','description','parentId'];

   
}
