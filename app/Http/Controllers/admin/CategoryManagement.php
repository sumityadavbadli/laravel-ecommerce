<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\manageCategory;
use Session;
class CategoryManagement extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function showInsertView() {
      $ids = manageCategory::all();
        return view('admin.create_category')->with('parentIds', $ids);
    }
    
    public function insert(Request $request) {
    $this->validate($request,[
        'categoryName' => 'required|min:4|unique:manage_categories,name',
        'categoryDesciption' => 'required',
        'parentCategory' => 'required|numeric'
    ]);
      
       $manage = new manageCategory;
       $manage->parentId = $request->parentCategory;
       $manage->name = $request->categoryName;
       $manage->description = $request->categoryDesciption;
       $manage->save();
        
        Session::flash('message', "Category Saved Successfully !");
        return Redirect::back();

    }

    public function showEditView(){
        $data = manageCategory::paginate(10);
        return view('admin.edit_category')->with('Table',$data);
    }
    
    public function showEditViewWithData($id) {
        $ids = manageCategory::all();
        $item = manageCategory::where('id',$id)->get();
        return view('admin.editData_category')->with(['item'=>$item,'parentIds'=> $ids]);
    }


    public function update(Request $request) {
    $this->validate($request,[
        'categoryName' => 'required|min:4',
        'categoryDesciption' => 'required',
        'parentCategory' => 'required|numeric'
    ]);
      
       $id=$request->itemId;
       $name=$request->categoryName;
       $description=$request->categoryDesciption;
       $parentId=$request->parentCategory;

       $manage = new manageCategory;
       $manage::where('id',$id)
              ->update([
                'name'=> $name,
                'description'=> $description,
                'parentId'=>$parentId
                ]);

     
        
        Session::flash('message', "Category Updated Successfully !");
        return Redirect()->action('admin\CategoryManagement@showEditView');

    }

    public function delete($id) {
      $manage = new manageCategory;
        $result = CategoryManagement::check($id);
      
        if($result) {
            Session::flash('message', "Category Deleted Successfully !");
            return Redirect::back();
        }
        else {
            Session::flash('error', "Oops Something  Went Wrong !");
            return Redirect::back(); 
        }

    }

     public function check($id) {
        $manage = new manageCategory;
        $childs = $manage::where('parentId',$id)->get();

            if(count($childs))
            {
                foreach ($childs as $child) {
//                    $manage::find($child->id)->delete();  
                    CategoryManagement::check($child->id);  
//                    return 1 ;
                }  
            }
            
                $manage::find($id)->delete();
                return 1;
            
          
        
     }


}

