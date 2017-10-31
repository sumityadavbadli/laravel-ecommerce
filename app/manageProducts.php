<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class manageProducts extends Model
{
    use Searchable;
    
    protected $primaryKey = 'productId'; // or null

    public $incrementing = false;
    
    public $fillable = ['productId','parentCategory','productName','modelNumber','shortDescription','regularPrice','salePrice','productWeight','productLength','productBreadth','productHeight','productDescription','productImage','productFullImage','productTags','productGallery','status'];
    
//    public function searchableAs()
//    {
//        return 'product_index';
//    }
    
     public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

}

