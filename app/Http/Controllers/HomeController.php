<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\manageCategory;
use App\manageProducts;
use App\specialProducts;
use App\popularProducts;
use Session;
use Crypt;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
// Getting Special Products        
        $myarray =[];
        $pId =[];
        $v1 = new specialProducts;
        $spcount=$v1::orderBy('created_at', 'desc')
               ->take(4)
               ->get();
        foreach($spcount as $count)
        {
        $pId[]=$count->productId;
        $myarray[]=specialProducts::find($count->productId)->manageProducts()->get();
        }
        
//  Getting Popular Products
        $myarray2 =[];
        $v2 = new popularProducts;
        // different select statement for different number of special products
        $noOfProducts = count($pId);
        
        if($noOfProducts==0 || $noOfProducts>4){
            $ppcount=$v2::orderBy('created_at', 'desc')
                ->take(8)
                ->get();    
        }
        
        if($noOfProducts==1){
            $ppcount=$v2::where('productId','!=', $pId[0])
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();    
        }
        if($noOfProducts==2){
            $ppcount=$v2::where('productId','!=', $pId[0])
                ->where('productId','!=', $pId[1])
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();    
        }
        
        if($noOfProducts==3){
            $ppcount=$v2::where('productId','!=', $pId[0])
                ->where('productId','!=', $pId[1])
                ->where('productId','!=', $pId[2])
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();    
        }
        
        if($noOfProducts==4){
            $ppcount=$v2::where('productId','!=', $pId[0])
                ->where('productId','!=', $pId[1])
                ->where('productId','!=', $pId[2])
                ->where('productId','!=', $pId[3])
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();    
        }
        
        
        foreach($ppcount as $count2)
        {
        $myarray2[]=popularProducts::find($count2->productId)->manageProducts()->get();
        }
        
        return view('home')->with(['product'=>$myarray,'Eproduct'=>$myarray2,'pId'=>$pId]);
    }
    
    public function productView($id='invalid') {
        if($id=='invalid')
        {
            Session::flash('blankRequest', "No Such Product is available !");
            return view('product-view');
        }
        else {
            $pd = new manageProducts;
            $singleProduct = $pd::where('productId',$id)->get();
            if(count($singleProduct))
            {
                return view('product-view')->with('singleProduct',$singleProduct);        
            }
            else
            {
                Session::flash('blankRequest', "No Such Product is available !");
                return view('product-view');
            }
            
        }
        
    }
    
    public function productsAll($id='invalid'){
         if($id=='invalid')
        {
            Session::flash('blankRequest', "No Such Product is available !");
            return view('products-in');
        }
        else {
            $secret = Crypt::decrypt($id);
            if(count($secret)){
                
                $value = manageCategory::where('id',$secret)->first();            
                $pageName = $value->name;
                $parentId = $value->parentId;
                
                $data = manageCategory::where('id',$parentId)->first();
                $parentName = $data->name;            
                
                $pd = new manageProducts;
                $productList = $pd::where('parentCategory',$secret)->paginate(15);    
                
                return view('products-in')->with(['productList'=>$productList,'pageName'=>$pageName,'parentName'=>$parentName]); 
            }
            else
            {
                Session::flash('blankRequest', "No Such Product is available !");
                return view('product-view');
            }
             
        }
    }
    
}
