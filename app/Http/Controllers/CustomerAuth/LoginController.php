<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\customerProfile;
use App\parentOrder;
use App\childOrders;
use App\Customer;
use App\guestParentOrder;
use App\guestChildOrders;
use Cookie;
use Request;
use View;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    public $redirectTo = '/customer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('customer.guest', ['except' => 'logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('customer');
    }
    
    public function authenticated() {
        $userId = Request::cookie('userId');
        if($userId) {

            $guestParent = new guestParentOrder;
            $guestParentItem = $guestParent::where('visitorId',$userId)->first();
                    
                if($guestParentItem) {

                    $guestOrderId = $guestParentItem->orderId;
                    $guestNoOfUnits = $guestParentItem->noOfUnits;
                    $guestTotalAmount = $guestParentItem->amount;
                    
                    $guestProducts = guestChildOrders::where([
                        ['orderId',$guestOrderId],
                        ['visitorId',$userId],
                        ])->get();
                        
                   //====================================================================
                   //   update the parentOrder with the guestParentOrder data
                    
                   // fetch orderId from parentOrdrs
                    $parent = parentOrder::where([
                        ['orderStatus',0],
                        ['custId',Auth::user()->custId],
                    ])->first();
                    
                    if($parent) {
                    
                    $parentOrderId = $parent->orderId;
                    
                    $successUpdate= $parent->update([
                        'noOfUnits' => $parent->noOfUnits + $guestNoOfUnits,
                        'amount' => $parent->amount+$guestTotalAmount,
                    ]);
                    
                    
                  if($successUpdate)   {
                    $userChild = new childOrders;
                    $userChildItem = $userChild::where('custId',Auth::user()->custId)->get();
                        

                    //-------------------------------------------------------------
                    // check for repeat child entry in guestChildOrders
                        
                    $repeatChildEntry=[];
                    foreach($userChildItem as $uItem) {
                        $repeatChildEntry[] = guestChildOrders::where([
                        ['orderId',$guestOrderId],
                        ['visitorId',$userId],
                        ['productId',$uItem->productId],
                        ])->get();
                    }
                        
                    $repeatPro = [];
                    foreach($repeatChildEntry as $re){
                        foreach($re as $ra){
                            $repeatPro[]= $ra;
                        }
                    }
                        
                    // now repeatPro contains the object of guestChildOrders which have repeat entry
  
                      
                      if(count($repeatPro)) {
                          $updateStatus = loginController::updateChildOrders($parentOrderId,$guestProducts,$repeatPro);
                           if($updateStatus) {
                            $done =   loginController::removeGuestData($userId,$guestOrderId);
                               if($done ){
                                   $cookie = Cookie::forget('userId');
                                    Session::flash('message', "Product Saved Successfully !");
                            return redirect()->action('customer\homeController@showHome')->withCookie($cookie);
                               }
                               else {
                            Session::flash('error', "Problem in updateChildOrders function");
                            return redirect()->action('customer\homeController@showHome');  
                               }

                          }
                          else {
                            Session::flash('error', "Problem in updateChildOrders function");
                            return redirect()->action('customer\homeController@showHome');              
                          }
                      }
                      else {
                          //create new entries with the existing order id
                          $createStatus = LoginController::createNewEntry($parentOrderId,$guestProducts);
                            
                          if($createStatus) {
                              $done1 = loginController::removeGuestData($userId,$guestOrderId);
                              
                              if($done1) {
                                  $cookie = Cookie::forget('userId');
                                Session::flash('message', "Product Saved Successfully !");
                            return redirect()->action('customer\homeController@showHome')->withCookie($cookie);      
                              }
                              else {
                                Session::flash('error', "Problem in createNewEntry function");
                                return redirect()->action('customer\homeController@showHome');      
                              }
                            
                          }
                          else {
                            Session::flash('error', "Problem in createNewEntry function");
                            return redirect()->action('customer\homeController@showHome');              
                          }
                          
                      }
                      
                  }
                   else {
                       return " Problem Occured during updating the parentOrders";
                   }       
                    }
                    else {
                        // first create new parentOrderEntry and then create new childOrder Entry
                        
                        $myParent = new parentOrder;
                        $myParent->orderId = $guestOrderId;
                        $myParent->custId = Auth::user()->custId;
                        $myParent->noOfUnits = $guestNoOfUnits;
                        $myParent->amount = $guestTotalAmount;
                        $saved = $myParent->save();
                        
                        if($saved) {
                            $createStatus = LoginController::createNewEntry($guestOrderId,$guestProducts);
                            
                          if($createStatus) {
                              $done3 = loginController::removeGuestData($userId,$guestOrderId);
                              if($done3) {
                                $cookie = Cookie::forget('userId');
                                Session::flash('message', "Product Saved Successfully !");
                                return redirect()->action('customer\homeController@showHome')->withCookie($cookie);    
                              }
                              else {
                                    Session::flash('error', "Problem in createNewEntry function");
                                    return redirect()->action('customer\homeController@showHome');      
                              }
                              
                          }
                          else {
                            Session::flash('error', "Problem in createNewEntry function");
                            return redirect()->action('customer\homeController@showHome');              
                          }   
                        }       
                    }
                    }
                else{
                    return "Guest Parent Order table is empty";
                }
                
            
            
//=============================================================================            

    } // end of check cookie if block
        else {
            if(Auth::user()->status)   
            {
                return redirect()->action('customer\homeController@showHome');
            }
            else
            {
                return redirect()->action('customer\completeUserProfile@createView');
            } 
        }
    }   // end of authenticated method
    

    public function createNewEntry($parentOrderId,$products){
                
        
        $child = new childOrders;
        $custId = Auth::user()->custId;
        $orderId = $parentOrderId;

        //----------------------------------------------------------------------------
         
        static $flag =0 ;
        
        foreach($products as $p) {
            $child = new childOrders;        
            $child->custId = $custId;
            $child->orderId = $orderId;
            $child->productId = $p->productId;
            $child->productName = $p->productName;
            $child->productSummary = $p->productSummary;
            $child->productQuantity = $p->productQuantity;
            $child->productPrice = $p->productPrice;
            $child->productImage = $p->productImage;         
            $check = $child->save();
                
              if(!$check){
                  $flag=1;
              }        
            }

          if(!$flag) {
              return 1;
          }
        else {
            return 0;
        }

    }
    
    public function updateChildOrders($orderId,$products,$repeatPro) {
        
        $custId = Auth::user()->custId;
        $myCounter = 0;
        $myCounter2 = 0;

        $child = new childOrders;  
        foreach($products as $p) {
            foreach($repeatPro as $rp) {
                
                if($p->productId == $rp->productId) {
                    $successUpdate = $child::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$p->productId],
                  ])->update([
                'productQuantity' => $p->productQuantity+$rp->productQuantity,
            ]);
                    if($successUpdate){
                        $myCounter = $myCounter+1;

                    }
                }
                
            }   // end of inner foreach
            
        } // end of outer foreach
        
    
//========================================================================================        
        if(count($repeatPro) == $myCounter)
        {
            
                $child1 = new childOrders;
                $tempoProducts = $products;
            
                $bakiProducts=[];
            
            
            $hello = $child1::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                  ])->get();
            
            $my2Counter = 1;
            foreach($tempoProducts as $tem) {
                $unchanged =0;
                foreach($hello as $hel) {
                    if($tem->productId == $hel->productId ) {
                        $unchanged = 1;
                    }
                }
                if($unchanged == 0) {
                    $bakiProducts[] = $tem->productId;        
                    
                    $child2 = new childOrders;
                    $child2->custId = $custId;
                    $child2->orderId = $orderId;
                    $child2->productId = $tem->productId;
                    $child2->productName = $tem->productName;
                    $child2->productSummary = $tem->productSummary;
                    $child2->productQuantity = $tem->productQuantity;
                    $child2->productPrice = $tem->productPrice;
                    $child2->productImage = $tem->productImage;         
                    $successCheck2 = $child2->save();
                    
                    if(!$successCheck2) {
                        $my2Counter = 0;
                    }
                }    
            }
            
            if($my2Counter) {
                return 1;
            }
            else {
                return 0;
            }
        
        }
        else {
            return 0;
        }
        
    
    }  
    
    public function removeGuestData($userId,$orderId) {
        
        $deleteParent = guestParentOrder::where([
            ['visitorId',$userId],
            ['orderId',$orderId],
        ])->delete();
        
        if($deleteParent) {
            $deleteChild = guestChildOrders::where([
            ['visitorId',$userId],
            ['orderId',$orderId],
            ])->delete();
            
            if($deleteChild) {
                // set callBack status of the user
                $callBack = Customer::where('custId',Auth::user()->custId)->update([
                    'callBack' => 1,
                ]);
                
                if($callBack) {
                    return 1;
                }
                else {
                    return 0;
                }
            }
        }
        
    }
}
