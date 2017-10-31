<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manageProducts;
use Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        
        if($request->has('q')) {
            $items = manageProducts::search($request->get('q'))->get();
            if(count($items))
            {
                return view('search-query')->with(['keyword'=>$request->q,'items'=>$items]);    
            }
            else
            {
                Session::flash('noResultFound', "Please try again with different keyword !");
                return view('search-query')->with('keyword',$request->q);    
            }
            
        }
        else {
            Session::flash('blankRequest', "Oops Something Wrong Happens !");
            return view('search-query');
        }
        
        
//        $error = ['error' => 'No results found, please try with different keywords.'];

//
//        if($request->has('q')) {
//
//            
//            $posts = manageProducts::search($request->get('q'))->get();
//
//            
//            return $posts->count() ? $posts : $error;
//
//        }

    }
    
    public function getData() {
        $items = manageProducts::all();
            if($items) {
                $list = [];
                foreach($items as $it) {
                    $list[]=$it->productName;
                    $productTags= $it->productTags;
                    $tagsArray = explode(",",$productTags);
                    foreach($tagsArray as $item) {
                        $list[] =$item;
                    }
                    $newlist = array_unique($list);
                    $hello = [];
                    foreach($newlist as $pro) {
                        $hello[]= $pro;
                    }
                }
                return response()->json([
                'items' => $hello,
                ]); 
            }

    }

}
