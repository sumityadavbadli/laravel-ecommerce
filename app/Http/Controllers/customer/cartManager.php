<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http;
use Illuminate\Support\Facades\Request;
use Session;
use Auth;
use App\customerProfile;
use App\Http\Requests;
use App\parentOrder;
use App\childOrders;

class cartManager extends Controller
{
        
    public function displayCart() {
        $parent = new parentOrder;
        $child = new childOrders;
        
        
        $custId = Auth::user()->custId;
          if($custId) {
            $parentData = $parent::where('custId',$custId)->get();
                
              if(!$parentData->isEmpty()) {
                  foreach($parentData as $pd1) {
                    $orderId = $pd1->orderId;
                    $noOfUnits = $pd1->noOfUnits;
                    $totalAmount = $pd1->amount;       
                  }
              }
              else {
                Session::flash('empty', "Hello ! You don't have any Pending Orders.");
                return view('customer/checkout');
              }
                
        }
        else {
            Session::flash('empty', "Hello ! You don't have any Pending Orders.");
            return view('customer/checkout');
        }
            
        $childData = $child::where('orderId',$orderId)->get();
        
        if(Auth::user()->status) {
            $customer = customerProfile::where('custId',Auth::user()->custId)->first();
            
            return view('customer/checkout')->with(['data'=>$childData,'price'=>$totalAmount,'quantity'=>$noOfUnits,'customer'=>$customer]);
        }
        else {
        return view('customer/checkout')->with(['data'=>$childData,'price'=>$totalAmount,'quantity'=>$noOfUnits]);
    
        }
                
    }
}
