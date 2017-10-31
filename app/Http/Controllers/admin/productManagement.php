<?php

namespace App\Http\Controllers\admin;
use Intervention\Image\ImageManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manageCategory;
use App\manageProducts;
use App\productImages;
use App\specialProducts;
use App\popularProducts;
use Session;
use Image; 
class productManagement extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function showInsertView() {
    	 $ids = manageCategory::where('parentId','!=',0)->get();
        return view('admin.create_products')->with('parentIds', $ids);
    }

    public function insert(Request $request){
    	$this->validate($request,[
    		'parentCategory'=>'required',
    		'productName'=>'required|min:4',
    		'modelNumber'=>'required',
    		'shortDescription'=>'required|min:20',
    		'regularPrice'=>'required|numeric',
    		'salePrice'=>'required|numeric',
            'productLength'=>'numeric',
    		'productWeight'=>'numeric',
            'productBreadth'=>'numeric',
            'productHeight'=>'numeric',
    		'productDescription'=>'required|min:20',
    		'productImage'=>'mimes:jpeg,bmp,png,jpg,gif',
    		'productTags'=>'required'
    		]);
        
        //setting up intervention 
        $manager = new ImageManager(array('driver' => 'imagick'));
        
        
        
            $value = $request->productName;  // request product Name
            $pdtId =str_limit($value,2,str_random(8));
            
            $product = new manageProducts;
            $product->productId = $pdtId;
            $product->parentCategory = $request->parentCategory;
            $product->productName = $request->productName;
            $product->modelNumber = $request->modelNumber;
            $product->shortDescription = $request->shortDescription;    
            $product->regularPrice = $request->regularPrice;
            $product->salePrice = $request->salePrice;
            $product->productWeight = $request->productWeight;
            $product->productLength = $request->productLength;
            $product->productBreadth = $request->productBreadth;
            $product->productHeight = $request->productHeight;
            $product->productDescription = $request->productDescription;
            //productImage described below
            $product->productTags = $request->productTags;
            $product->status= 1;

            // image processing
            $image = $request->productImage;
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            
            $dir = public_path("uploads/products/".$request->productName);
            $thumbs = public_path("uploads/products/".$request->productName."/thumbs");
            $bigImage = public_path("uploads/products/".$request->productName."/image");
            if(! \File::isDirectory($dir))
            {
                \File::makeDirectory($dir,493,true);
                \File::makeDirectory($thumbs,493,true);
                \File::makeDirectory($bigImage,493,true);
            }
                
            $path1 = $thumbs."/". $filename;    
            $path2 = $bigImage."/". $filename;    

            $product->productImage = $path1;
            $product->productFullImage = $path2;
        
            Image::make($image->getRealPath())->resize(300, 300)->save($path1); 
            Image::make($image->getRealPath())->resize(600, 600)->save($path2); 
    
            $product->save();
        
            Session::flash('message', "Product Saved Successfully !");
            return Redirect::back();

    }

    public function showEditView()
    {
        $data = manageProducts::paginate(10);
        return view('admin.edit_products')->with('Table',$data);
    	
    }
    
    public function showEditViewWithData($id) {
        $ids = manageCategory::where('parentId','!=',0)->get();
        $item = manageProducts::where('productId',$id)->get();
        return view('admin.editData_products')->with(['item'=>$item,'parentIds'=> $ids]);
    }
    
       public function update(Request $request) {
        $this->validate($request,[
            'productImage'=>'mimes:jpeg,bmp,png,jpg,gif',
            'parentCategory'=>'required',
    		'productName'=>'required|min:4',
    		'modelNumber'=>'required',
    		'shortDescription'=>'required|min:20',
    		'regularPrice'=>'required|numeric',
    		'salePrice'=>'required|numeric',
            'productLength'=>'numeric',
    		'productWeight'=>'numeric',
            'productBreadth'=>'numeric',
            'productHeight'=>'numeric',
    		'productDescription'=>'required|min:20',
    		'productTags'=>'required'
        ]);
        
        if($request->productImage)
        {
            //-------------------------------------------------------------------
            // Delete existing folder
                    $dir = public_path("uploads/products/".$request->productName);
                    $result = productManagement::delTree($dir);
            
                     if($result == 0)
                     {
                        Session::flash('error', "Something Went Wrong !");
                        return Redirect()->action('admin\productManagement@showEditView');
                     }
            //-------------------------------------------------------------------
            
        
            //-------------------------------------------------------------------
            //setting up intervention 
            $manager = new ImageManager(array('driver' => 'imagick'));
            $image = $request->productImage;
            $filename  = time() . '.' . $image->getClientOriginalExtension();        

            $dir = public_path("uploads/products/".$request->productName);
            $thumbs = public_path("uploads/products/".$request->productName."/thumbs");
            $bigImage = public_path("uploads/products/".$request->productName."/image");
        
            if(! \File::isDirectory($dir))
            {
                \File::makeDirectory($dir,493,true);
                \File::makeDirectory($thumbs,493,true);
                \File::makeDirectory($bigImage,493,true);
            } 
            
            $path1 = $thumbs."/". $filename;    
            $path2 = $bigImage."/". $filename;    
            
            Image::make($image->getRealPath())->resize(300, 300)->save($path1); 
            Image::make($image->getRealPath())->resize(600, 600)->save($path2);    
            
            $imageUrl1 = $path1;
            $imageUrl2 = $path2;
            //----------------------------------------------------------------------
            
        }
        else
        {
            $imageUrl1 = $request->imageUrl;    
            $imageUrl2 = $request->imageFullUrl;    
        }
        
            //----------------------------------------------------------------------    
            // Updating the Database
            $productId = $request->productId;
            $product = new manageProducts;
            $product::where('productId',$productId)
              ->update([
                'parentCategory' => $request->parentCategory,
                'productName' => $request->productName,
                'modelNumber' => $request->modelNumber,
                'shortDescription' => $request->shortDescription,
                'regularPrice' => $request->regularPrice,
                'salePrice' => $request->salePrice,
                'productWeight' =>  $request->productWeight,
                'productLength' => $request->productLength,
                'productBreadth' => $request->productBreadth,
                'productHeight' => $request->productHeight,
                'productDescription' => $request->productDescription,
                'productImage' => $imageUrl1,
                'productFullImage' => $imageUrl2,
                'productTags' => $request->productTags,
                'status' => $request->status
                ]);
        
        
        Session::flash('message', "Product Updated Successfully !");
        return Redirect()->action('admin\productManagement@showEditView');
    }
    
    
    public function delete($id) {
       $product = new manageProducts;
        $data = $product::where('productId',$id)->first();
        
        $dir = public_path("uploads/products/".$data->productName);
        
        $result = productManagement::delTree($dir);
       
        if($result != 0)
        {
            $product::find($id)->delete();
            specialProducts::find($id)->delete();
            popularProducts::find($id)->delete();
            Session::flash('message', "Product Deleted Successfully !");
            return Redirect::back();
        }
        else
        {
            Session::flash('error', "Something  Went Wrong !");
            return Redirect::back(); 
        }
        
    
    }
    
        public  function delTree($dir)
        { 
            $files = array_diff(scandir($dir), array('.', '..')); 

            foreach ($files as $file) { 
                (is_dir("$dir/$file")) ? productManagement::delTree("$dir/$file") : unlink("$dir/$file"); 
            }

            return rmdir($dir); 
        }
    
}
