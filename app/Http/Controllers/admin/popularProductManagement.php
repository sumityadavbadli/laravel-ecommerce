<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manageProducts;
use App\popularProducts;
use App\specialProducts;
use Session;

class popularProductManagement extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function showData()
    {
// getting special products
        $pId =[];
        $v1 = new specialProducts;
        $spcount=$v1::orderBy('created_at', 'desc')
               ->take(4)
               ->get();
        foreach($spcount as $count)
        {
        $pId[]=$count->productId;
        }
        
        $value=['0','0','0','0'];
        for($i=0;$i<count($pId);$i++)
        {
            $value[$i]=$pId[$i];
            
        }

        $sp = popularProducts::all();
        $data = manageProducts::paginate(10);    
        return view('admin.addpopularProducts')->with(['Table'=>$data,'special'=>$sp,'displayed'=>$value]);
    }
    
    public function add($id) {
        $sp = new popularProducts;
        if(empty($id)) {
            Session::flash('message', "Something Went Wrong ! ");
            return Redirect::back();
        }
        else {
            $sp->productId = $id;
            $sp->save();
            
            Session::flash('message', "Popular Product added Successfully !");
            return Redirect::back();

        }
    }
    
    public function delete($id) {
        
        if(empty($id)) {
            Session::flash('error', "Something Went Wrong ! ");
            return Redirect::back();
        }
        else {
            $rows = popularProducts::find($id)->delete();
                if($rows != 0) {
                    Session::flash('message', "Popular Product Deleted Successfully !");
                    return Redirect::back();
                }
                else {
                    Session::flash('error', "Something  Went Wrong !");
                return Redirect::back(); 
                }
        }
    } // End of dele function
}
