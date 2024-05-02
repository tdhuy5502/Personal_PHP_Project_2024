<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProductController extends Controller
{
    //Admin function
    public function checkLogin()
    {
        $admin_id = Session::get('idAdmin');
        if($admin_id)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->route('admin.login')->send();
        }
    }
    public function add_category()
    {   
        $this->checkLogin();
        return view('admin.add_category_product');
    }
    public function all_category()
    {
        $this->checkLogin();
        $all_category_product = Category::orderBy('category_id','DESC')->get();

        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);

        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
        
    }
    public function save_category_product(AddProductRequest $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->created_at = date('Y-m-d H:i:s');

        $category->save();

        return redirect()->route('admin.add_category')->with('message','Added Success');
    }
    public function unactive_category_product($id)
    {
        Category::where('category_id',$id)->update(['category_status' => 0]);
        Session::put('active_message','Unactive product successfully');
        return redirect()->route('admin.all_category');
    }
    public function active_category_product($id)
    {
        Category::where('category_id',$id)->update(['category_status' => 1]);
        Session::put('active_message','Active product successfully');
        return redirect()->route('admin.all_category');
    }

    public function edit_category_product($id)
    {
        $this->checkLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$id)->get();
        
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(AddProductRequest $request , $id)
    {
        $data = $request->all();

        $category = Category::find($id);
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->updated_at = date('Y-m-d H:i:s');

        $category->save();

        return redirect()->route('admin.all_category')->with('confirm_update','Update Successful');
    }
    public function delete_category_product($id)
    {
        Category::where('category_id',$id)->delete();

        return redirect()->route('admin.all_category')->with('confirm_delete','Delete Successful');
    }


    //Frontend Function
    public function show_category($id)
    {
        $cate_product = Category::where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','desc')->get();
        
        $category_by_id = Product::join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_category_product.category_id',$id)->get();

        $category_name = Category::where('tbl_category_product.category_id',$id)->get();

        return view('pages.category.show_category')->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name); 
    }
}
