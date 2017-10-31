<?php

namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\parentOrder;
use App\childOrders;
use App\tempOrders;
use Session;
use View;
use Cookie;

class cartController extends Controller
{
    public function checkout(Request $request) {
              
        //----------------------------------------------------------------------------------
        // Fetching data from mycart.js        

        $products = session('products');
        $noOfUnits = session('noOfUnits');
        $totalAmount = session('totalAmount');
        
          
       
        $parent = new parentOrder;
        $child = new childOrders;
        $custId = Auth::user()->custId;
        
        $check1 = CartController::createTempOrders($products,$custId);
        
        if($check1) {
            $checkOrder = $parent::where('custId',$custId)->orderBy('created_at','desc')->first();
            
            // if order is alrady there then update the database else create a new entry
            
        if($checkOrder)             
        {
            $successUpdate= $parent::where('custId',$custId)->update([
                'noOfUnits' => $checkOrder->noOfUnits + $noOfUnits,
                'amount' => $checkOrder->amount+$totalAmount,
            ]);
                
            if($successUpdate) {
                // search if product alrady exits in guestChildOrders
                
                $tempProducts = tempOrders::where('userId',$custId)->get();
                $repeatChildEntry=[];
                foreach($tempProducts as $pp) {
                  $repeatChildEntry[] = $child::where([
                    ['custId',$custId],
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
                    $successChildOrders = CartController::updateGuestChildOrders($repeatPro,$checkOrder->orderId,$custId);
                }
                else {
                    $successChildOrders = CartController::createGuestChildOrders($custId,$checkOrder->orderId);   
                }
                
                if($successChildOrders) {
                    Session::flash('message', "Order Saved successfully !");
                    return redirect('customer/pending-orders');   
                } else {
                    Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
                    return redirect('customer/pending-orders');   
                }
                
            }
            else{
                Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
                return redirect('customer/pending-orders');  
            }
                
            
            
        }
            
        else {
            $createSuccess = CartController::createOrderWithCookie($products,$totalAmount,$noOfUnits);
            
            if($createSuccess) {
                Session::flash('message', "Cart Saved Successfully!");
                return redirect('customer/pending-orders');   
            }
            else {
                Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
                return redirect('customer/pending-orders');    
            }
        }   
            
   
        }
        else {
            Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
            return redirect('customer/pending-orders');  
        }
        
   
    } // end of checkOut function 
    
    public function createTempOrders($products,$custId) {
        
        static $tempStatus = 0;
        CartController::emptyTempOrders($custId);
         foreach($products as $pi) {
            $temp = new tempOrders;
            $temp->userId = $custId;
            $temp->productId = $pi->id;
            $temp->productName = $pi->name;
            $temp->productSummary = $pi->summary;
            $temp->productQuantity = $pi->quantity;
            $temp->productPrice = $pi->price;
            $temp->productImage = $pi->image;         
            $tempo = $temp->save();
             if(!$tempo) {
                 $tempStatus = 1;
             }
        }
        
        if(!$tempStatus) {
            return 1;
        }
        else {
            return 0;
        }
    }
    
    public function emptyTempOrders($custId) {
        tempOrders::where('userId',$custId)->delete();
    }
    
    public function createOrderWithCookie($products,$totalAmount,$noOfUnits){
                
        $parent = new parentOrder;
        $child = new childOrders;
        $custId = Auth::user()->custId;
        

        //----------------------------------------------------------------------------
        // Creating order Id 
        
        $value = "order";  // request product Name
        $ran =str_limit($value,2,str_random(8));
        $orderId = $ran.time();
        
        
        //----------------------------------------------------------------------------
        // Saving data into parent order
        
        $parent->orderId = $orderId;
        $parent->custId = $custId;
        $parent->noOfUnits = $noOfUnits;
        $parent->amount = $totalAmount;
        $saved = $parent->save();
        
        if(!$saved){
            Session::flash('error', "Orders cannot be processed right Now ! Come Back Later ...");
            return redirect('customer/pending-orders');  
        }
        else {
            //------------------------------------------------------------------------
            // Data into guestParentOrders saved successfully
            
            
            $childOrderResult = CartController::createGuestChildOrders($custId,$orderId);
            
            if($childOrderResult) {
                return 1;
            } else {
                 return 0;
            }


            
        }   // end of guestParentOrders saved successfully
    }
    
    public function createGuestChildOrders($custId,$orderId) {
        
         $tempProducts = tempOrders::where('userId',$custId)->get();
        $flag =0 ;
        
            foreach($tempProducts as $p) {
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
    
    public function updateGuestChildOrders($repeatPro,$orderId,$custId) {
        
        $products = tempOrders::where('userId',$custId)->get();
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
                $tempoProducts = tempOrders::where('userId',$custId)->get();
            
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
    
    public function updatePlusQuantity(Request $request) {
       if ($request->isMethod('post')){

            $productId = $request->productId;
            $currentQuantity =  $request->quantity;
            $productPrice = $request->productPrice;
           
            $custId = Auth::user()->custId;
            $getOrderId = parentOrder::where('custId',$custId)->first();
            $orderId = $getOrderId->orderId;

            $parentData = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->first();
            
            $parentSuccess = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->update([
                'noOfUnits' => $parentData->noOfUnits + 1,
                'amount' => $parentData->amount + $productPrice,
            ]);
           
            if($parentSuccess) {
                $newParentData = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->first();
            
            $newNoOfUnits = $newParentData->noOfUnits;
            $newAmount = $newParentData->amount;

                            
                $childData = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                $childSuccess = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->update([
                    'productQuantity'=>$childData->productQuantity + 1,
                ]);    
                                        
                
                $newChildData = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                $newProductQuantity = $newChildData->productQuantity;
                
                return response()->json([
                'newProductQuantity' => $newProductQuantity,
                'productAmount'=> $productPrice * $newProductQuantity,
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
            
            $custId = Auth::user()->custId;
            $getOrderId = parentOrder::where('custId',$custId)->first();
            $orderId = $getOrderId->orderId;

           $check = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
           
           $previousQuantity = $check->productQuantity;

           if($previousQuantity > 1) {
            $parentData = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->first();
            
            $parentSuccess = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->update([
                'noOfUnits' => $parentData->noOfUnits - 1,
                'amount' => $parentData->amount - $productPrice,
            ]);
            
 
            
            if($parentSuccess) {
                $newParentData = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->first();
            
            $newNoOfUnits = $newParentData->noOfUnits;
            $newAmount = $newParentData->amount;
            
                
                $childData = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                $childSuccess = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->update([
                    'productQuantity'=>$childData->productQuantity - 1,
                ]);
                
                $newChildData = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->first();
                
                
                $newProductQuantity = $newChildData->productQuantity;
                

            return response()->json([
                'newProductQuantity' => $newProductQuantity,
                'productAmount' => $productPrice * $newProductQuantity,
                 'newNoOfUnits' => $newNoOfUnits,
                 'newTotalAmount' => $newAmount,
                 
            ]);     
            }

               
           } // end of check for negatives
           else {
                           
               $checkParentData = parentOrder::where([
                ['custId', $custId],
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
       
            $custId = Auth::user()->custId;
            $getOrderId = parentOrder::where('custId',$custId)->first();
            $orderId = $getOrderId->orderId;

            $parentData = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->first();
            
            $childData = childOrders::where([
                ['custId',$custId],
                ['orderId',$orderId],
                ['productId',$productId],
            ])->first();
            
            $parentSuccess = parentOrder::where([
                ['custId', $custId],
                ['orderId', $orderId],
            ])->update([
                'noOfUnits' => $parentData->noOfUnits - $childData->productQuantity,
                'amount' => $parentData->amount - $childData->productPrice,
            ]);
            
            
            if($parentSuccess) {
                $childDelete = childOrders::where([
                    ['custId',$custId],
                    ['orderId',$orderId],
                    ['productId',$productId],
                ])->delete();
                
                if($childDelete) {
                    $getParentData = parentOrder::where([
                        ['custId', $custId],
                        ['orderId', $orderId],
                        ])->first();
                    
                    if($getParentData->noOfUnits == 0) {
                        $parentDelete = parentOrder::where([
                            ['custId', $custId],
                            ['orderId', $orderId],
                            ])->delete();
                        
                        return response()->json([
                        'delete' => '1',
                        ]);         
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
    
} // end of class

