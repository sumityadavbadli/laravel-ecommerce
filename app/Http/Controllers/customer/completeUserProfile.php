<?php

namespace App\Http\Controllers\customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customer;
use App\customerProfile;

class completeUserProfile extends Controller
{
    public function createView() {
        $custId = Auth::user()->custId;
        $custName = Auth::user()->name;
        $abs = explode(" ",$custName);
        $count = count($abs);
        if($count==1)
        {
            $firstName =$abs[0];
            $lastName = "Empty";
        }
        else if($count>1) {
            $firstName =$abs[0];
            $lastName = $abs[$count-1];
        }
        else {
            $firstName = $abs[0];
            $lastName= $abs[1];    
        }
        
        $custEmail = Auth::user()->email;
        
        return view('customer.userInfo')->with(['id'=>$custId,'firstName'=>$firstName,'lastName'=>$lastName, 'email'=>$custEmail]);
    }
    
    
    public function saveToDb(Request $request) {
        $this->validate($request,[
    		'firstName'=>'required',
    		'lastName'=>'required',
    		'primaryEmail'=>'required',
    		'AlternateEmail'=>'email',
    		'PrimaryMobileNumber'=>'required|numeric|min:10',
    		'AlternateMobileNumber'=>'numeric|min:10',
            'CompleteAddress'=>'required',
    		'StreetNumber'=>'required|numeric',
            'pinCode'=>'required|numeric|min:6',
            'CityAndCountry'=>'required'
    		]);
            
        
        $userId = Auth::user()->custId;
        
        $customer = new customerProfile;
        $customer->custId = $userId;
        $customer->firstName = $request->firstName;
        $customer->lastName = $request->lastName;
        $customer->email = $request->primaryEmail;
        $customer->altEmail = $request->AlternateEmail;
        $customer->contact = $request->PrimaryMobileNumber;
        $customer->altContact = $request->AlternateMobileNumber;
        $customer->address = $request->CompleteAddress;
        $customer->street = $request->StreetNumber;
        $customer->pinCode = $request->pinCode;
        $customer->location = $request->CityAndCountry;
        $saved = $customer->save();         // return 1 if true
        
        if($saved){
            $parent = new Customer;
            $true = $parent::where('custId',$userId)
              ->update([
                'status'=> '1'
                ]);
        
            if($true) {
                
                if(Auth::user()->callBack)  {       // if user have items in cart
//                    $check = $parent::where('custId',$userId)->update([
//                    'callBack'=> '0'
//                    ]); 
                        Session::flash('message', "Profile Updated Successfully !");
                        return Redirect()->action('customer\cartManager@displayCart');    
                }
                else {
                    Session::flash('message', "Profile Updated Successfully !");
                    return redirect('customer/home');    
                }            
            }
            else {
                Session::flash('error', "Oops something went wrong !");
                return redirect('customer/home');
            }
        
        }
        else {
            Session::flash('error', "Oops something went wrong !");
            return redirect('customer/home');
        }
    }   // end of save to db
    
    
    
    public function Insert() {
        // insert data to table
    }
    
    public function Update() {
        // update data to table
    }
    
}
