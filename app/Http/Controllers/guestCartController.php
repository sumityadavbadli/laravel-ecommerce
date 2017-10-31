<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\guestParentOrder;
use App\guestChildOrders;
use App\tempOrders;
use Session;
use View;
use Cookie;


class guestCartController extends Controller
{
    public function checkout(Request $request) {
        
        
        //----------------------------------------------------------------------------------
        // Fetching data from mycart.js
        
        $products = json_decode($request->products);
        $totalAmount = $request->price;
        $noOfUnits = $request->quantity;
        
        //---------------------------------------------------------------------------------
        // Redirecting if the user is login
        
        if(Auth::user())
       {
            return redirect()->action('customer\cartController@checkout')->with(['products'=>$products,'totalAmount'=>$totalAmount,'noOfUnits'=>$noOfUnits]);
           
       }
        
        
        
        $parent = new guestParentOrder;
        $child = new guestChildOrders;
        
        //---------------------------------------------------------------------------------
             
        // if cookie is alrady there then update the database else create a new entry

        
        if(Auth::guest())
        {
        
        $userId = Cookie::get('userId');
        if($userId)             
        {
        
          guestCartController::createTempOrders($products,$userId);
            
          $checkOrder = $parent::where('visitorId',$userId)->first();
          
            if($checkOrder) {
               $successUpdate= $parent::where('visitorId',$userId)->update([
                'noOfUnits' => $checkOrder->noOfUnits + $noOfUnits,
                'amount' => $checkOrder->amount+$totalAmount,
            ]);
                
            if($successUpdate) {
                // search if product alrady exits in guestChildOrders
                
                $tempProducts = tempOrders::where('userId',$userId)->get();
                $repeatChildEntry=[];
                foreach($tempProducts as $pp) {
                  $repeatChildEntry[] = $child::where([
                    ['visitorId',$userId],
                    ['orderId',$checkOrder->orderId],
                    ['productId',$pp->productId],
                  ])->get();
                }
                
                $repeatPro = [];
                foreach($repeatChildEntry as $re){
                    foreach($re as $ra){
                        $repeatPro[]= $ra;
                    }
                }

                

     
                if(count($repeatPro)) {
                    $successChildOrders = guestCartController::updateGuestChildOrders($repeatPro,$checkOrder->orderId,$userId);
                }
                else {
                    $successChildOrders = guestCartController::createGuestChildOrders($userId,$checkOrder->orderId);    
                    
                }
                
                if($successChildOrders) {
                    Session::flash('message', "Order Saved successfully !");
                    return redirect('/pending-orders');   
                } else {
                    Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
                    return redirect('/pending-orders');   
                }
                
            }
                
            }
            else {
              guestCartController::createOrderWithCookie($products,$totalAmount,$noOfUnits);
            }
        }
        else {
            $createSuccess = guestCartController::createOrderWithCookie($products,$totalAmount,$noOfUnits);
            
            if($createSuccess) {
                Session::flash('message', "Cart Saved Successfully!");
                return redirect('/pending-orders');   
            }
            else {
                Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
                return redirect('/pending-orders');    
            }
        }
        
        } // end of if user is guest
        

    } // end of checkOut function 
  
    public function createTempOrders($products,$userId) {

        guestCartController::emptyTempOrders($userId);
         foreach($products as $pi) {
            $temp = new tempOrders;
            $temp->userId = $userId;
            $temp->productId = $pi->id;
            $temp->productName = $pi->name;
            $temp->productSummary = $pi->summary;
            $temp->productQuantity = $pi->quantity;
            $temp->productPrice = $pi->price;
            $temp->productImage = $pi->image;         
            $tempo = $temp->save();
        }
    }
        
    public function createOrderWithCookie($products,$totalAmount,$noOfUnits){
                
        $parent = new guestParentOrder;
        $child = new guestChildOrders;
        
        $cookieValue = str_random(8).time();
        $minutes = "1440";  // 24 hours
        Cookie::queue('userId', $cookieValue, $minutes);
        
        
        $visitor = $cookieValue;
        
        guestCartController::createTempOrders($products,$visitor);
        //----------------------------------------------------------------------------
        // Creating order Id 
        
        $value = "order";  // request product Name
        $ran =str_limit($value,2,str_random(8));
        $orderId = $ran.time();
        
        
        //----------------------------------------------------------------------------
        // Saving data into parent order
        
        $parent->orderId = $orderId;
        $parent->visitorId = $visitor;
        $parent->noOfUnits = $noOfUnits;
        $parent->amount = $totalAmount;
        $saved = $parent->save();
        
        if(!$saved){
            Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
            return view('checkout');
        }
        else {
            //------------------------------------------------------------------------
            // Data into guestParentOrders saved successfully
            
            
            $childOrderResult = guestCartController::createGuestChildOrders($visitor,$orderId);
            
            if($childOrderResult) {
                return 1;
            } else {
                 return 0;
            }


            
        }   // end of guestParentOrders saved successfully
    }
    
    public function createGuestChildOrders($visitor,$orderId) {
        
         $tempProducts = tempOrders::where('userId',$visitor)->get();
        $flag =0 ;
        
            foreach($tempProducts as $p) {
                $child = new guestChildOrders;        
                $child->visitorId = $visitor;
                $child->orderId = $orderId;
                $child->productId = $p->productId;
                $child->productName = $p->productName;
                $child->productSummary = $p->productSummary;
                $child->productQuantity = $p->productQuantity;
                $child->productPrice = $p->productPrice;
                $child->productImage = $p->productImage;         
                $check = $child->save();
                
                if($check){
                    $flag=$flag+1;
                }        
            }

          if(count($tempProducts) == $flag) {
              return 1;
          }
        else {
            return 0;
        }
            
    }
    
    public function updateGuestChildOrders($repeatPro,$orderId,$userId) {
        
        $products = tempOrders::where('userId',$userId)->get();
        $myCounter = 0;
        $myCounter2 = 0;

        $child = new guestChildOrders;  
        foreach($products as $p) {
            foreach($repeatPro as $rp) {
                
                if($p->productId == $rp->productId) {
                    $successUpdate = $child::where([
                    ['visitorId',$userId],
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
            
                $child1 = new guestChildOrders;
                $tempoProducts = tempOrders::where('userId',$userId)->get();
            
                $bakiProducts=[];
            
            
            $hello = $child1::where([
                    ['visitorId',$userId],
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
                    
                    $child2 = new guestChildOrders;
                    $child2->visitorId = $userId;
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
    
    public function emptyTempOrders($userId) {
        tempOrders::where('userId',$userId)->delete();
    }
    
    public function updatePlusQuantity(Request $request) {
       if ($request->isMethod('post')){
            $productId = $request->productId;
            
            $currentQuantity =  $request->quantity;
            $productPrice = $request->productPrice;
            
            $userId = Cookie::get('userId');
            $getOrderId = guestParentOrder::where('visitorId',$userId)->first();
            $orderId = $getOrderId->orderId;

            $guestParentData = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->first();
            
            $guestParentSuccess = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->update([
                'noOfUnits' => $guestParentData->noOfUnits + 1,
                'amount' => $guestParentData->amount + $productPrice,
            ]);
            
            
            if($guestParentSuccess) {
                $newParentData = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->first();
            
            $newNoOfUnits = $newParentData->noOfUnits;
            $newAmount = $newParentData->amount;
            
                
                $guestChildData = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                $guestChildSuccess = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->update([
                    'productQuantity'=>$guestChildData->productQuantity + 1,
                ]);
                
                $newChildData = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                
                $newProductQuantity = $newChildData->productQuantity;
                
//            return response()->json([
//                'productQuantity' => $productId,
//                'totalQuantity' => $currentQuantity,
//                'totalAmount' => $productPrice,
//                 'userId' => $userId,
//                 'orderId' => $orderId,
//                 'noOfUnits' => $newNoOfUnits,
//                 'amount' => $newAmount,
//                 'newProductQuantity' => $newProductQuantity,
//            ]);     
            return response()->json([
//                'productQuantity' => $productId,
//                'totalQuantity' => $currentQuantity,
//                 'userId' => $userId,
//                 'orderId' => $orderId,
                'newProductQuantity' => $newProductQuantity,
                'productAmount' => $productPrice * $newProductQuantity,
                 'newNoOfUnits' => $newNoOfUnits,
                 'newTotalAmount' => $newAmount,
                 
            ]);     
            }
            
        }

    }
    
    public function updateMinusQuantity(Request $request) {
        
       if ($request->isMethod('post')){
            $currentQuantity =  $request->quantity;
            $productId = $request->productId;
            $productPrice = $request->productPrice;
            
            $userId = Cookie::get('userId');
            $getOrderId = guestParentOrder::where('visitorId',$userId)->first();
            $orderId = $getOrderId->orderId;

           $check = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
           
           $previousQuantity = $check->productQuantity;
           
           if($previousQuantity > 1) {
            $guestParentData = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->first();
            
            $guestParentSuccess = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->update([
                'noOfUnits' => $guestParentData->noOfUnits - 1,
                'amount' => $guestParentData->amount - $productPrice,
            ]);
            
 
            
            if($guestParentSuccess) {
                $newParentData = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->first();
            
            $newNoOfUnits = $newParentData->noOfUnits;
            $newAmount = $newParentData->amount;
            
                
                $guestChildData = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                $guestChildSuccess = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->update([
                    'productQuantity'=>$guestChildData->productQuantity - 1,
                ]);
                
                $newChildData = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                
                $newProductQuantity = $newChildData->productQuantity;
                
//            return response()->json([
//                'productQuantity' => $productId,
//                'totalQuantity' => $currentQuantity,
//                'totalAmount' => $productPrice,
//                 'userId' => $userId,
//                 'orderId' => $orderId,
//                 'noOfUnits' => $newNoOfUnits,
//                 'amount' => $newAmount,
//                 'newProductQuantity' => $newProductQuantity,
//            ]);     
            return response()->json([
//                'productQuantity' => $productId,
//                'totalQuantity' => $currentQuantity,
//                 'userId' => $userId,
//                 'orderId' => $orderId,
                'newProductQuantity' => $newProductQuantity,
                'productAmount' => $productPrice * $newProductQuantity,
                 'newNoOfUnits' => $newNoOfUnits,
                 'newTotalAmount' => $newAmount,
                 
            ]);     
            }

               
           } // end of check for negatives
           else {
                           
               $checkParentData = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->first();
               
               return response()->json([
                'newProductQuantity' => $previousQuantity,
                'productAmount' => $productPrice * $previousQuantity,
                 'newNoOfUnits' => $checkParentData->noOfUnits,
                 'newTotalAmount' => $checkParentData->amount,
                 
            ]);     
           }
           
        } // end of check post method

    } // end of update MinusQuantity
    
    public function deleteProductRow(Request $request) {
        if ($request->isMethod('post')){
            $productId = $request->productId;
       
            $userId = Cookie::get('userId');
            $getOrderId = guestParentOrder::where('visitorId',$userId)->first();
            $orderId = $getOrderId->orderId;

            $guestParentData = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->first();
            
            $guestChildData = guestChildOrders::where([
                ['visitorId',$userId],
                ['orderId',$orderId],
                ['productId',$productId],
            ])->first();
            
            $guestParentSuccess = guestParentOrder::where([
                ['visitorId', $userId],
                ['orderId', $orderId],
            ])->update([
                'noOfUnits' => $guestParentData->noOfUnits - $guestChildData->productQuantity,
                'amount' => $guestParentData->amount - $guestChildData->productPrice,
            ]);
            
            
            
            
            if($guestParentSuccess) {
                $guestChildDelete = guestChildOrders::where([
                    ['visitorId',$userId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->delete();
                
                if($guestChildDelete) {
                    $getParentData = guestParentOrder::where([
                        ['visitorId', $userId],
                        ['orderId', $orderId],
                        ])->first();
                    
                    if($getParentData->noOfUnits == 0) {
                        $parentDelete = guestParentOrder::where([
                            ['visitorId', $userId],
                            ['orderId', $orderId],
                            ])->delete();
                        
                        $cookie = Cookie::forget('userId');
                        
                        return response()->json([
                        'delete' => '1',
                        ])->withCookie($cookie);         
                    }
                    
                    return response()->json([
                        'success' => '1',
                        'newNoOfUnits' => $getParentData->noOfUnits,
                        'newTotalAmount' => $getParentData->amount,
                    ]);     
                }
                
                
            }
        }
    }


}
