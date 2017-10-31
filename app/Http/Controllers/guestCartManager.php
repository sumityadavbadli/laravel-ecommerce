<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http;
use Illuminate\Support\Facades\Request;
use Session;
use Auth;
use App\guestParentOrder;
use App\guestChildOrders;

class guestCartManager extends Controller
{
  public function displayCart() {
        $parent = new guestParentOrder;
        $child = new guestChildOrders;
        
        
        $userId = Request::cookie('userId');
          if($userId) {
            $parentData = $parent::where('visitorId',$userId)->get();
                
              if(!$parentData->isEmpty()) {
                  foreach($parentData as $pd1) {
                    $orderId = $pd1->orderId;
                    $noOfUnits = $pd1->noOfUnits;
                    $totalAmount = $pd1->amount;       
                  }
              }
              else {
                  Session::flash('error', "Oops Something Went Wrong!");
                  return view('checkout');
              }
                
        }
        else {
            Session::flash('empty', "Hello ! You don't have any Pending Orders.");
            return view('checkout');
        }
            
        
        $childData = $child::where('orderId',$orderId)->get();
        
        return view('checkout')->with(['data'=>$childData,'price'=>$totalAmount,'quantity'=>$noOfUnits,'userId'=>$userId]);
        
    }
    
    
}
