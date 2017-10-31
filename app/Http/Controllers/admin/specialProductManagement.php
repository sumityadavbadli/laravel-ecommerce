<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manageProducts;
use App\specialProducts;
use Session;

class specialProductManagement extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function showData()
    {
        $sp = specialProducts::all();
        $data = manageProducts::paginate(10);    
        return view('admin.addSpecialProducts')->with(['Table'=>$data,'special'=>$sp]);
    }
    
    public function add($id) {
        $sp = new specialProducts;
        if(empty($id)) {
            Session::flash('message', "Something Went Wrong ! ");
            return Redirect::back();
        }
        else {
            $sp->productId = $id;
            $sp->save();
            
            Session::flash('message', "Special Product added Successfully !");
            return Redirect::back();

        }
    }
    
    public function delete($id) {
        
        if(empty($id)) {
            Session::flash('error', "Something Went Wrong ! ");
            return Redirect::back();
        }
        else {
            $rows = specialProducts::find($id)->delete();
                if($rows != 0) {
                    Session::flash('message', "Special Product Deleted Successfully !");
                    return Redirect::back();
                }
                else {
                    Session::flash('error', "Something  Went Wrong !");
                return Redirect::back(); 
                }
        }
    } // End of dele function
    
} // end of class
