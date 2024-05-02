<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandProductController extends Controller
{
    //
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
    public function add_brand()
    {   
        $this->checkLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand()
    {   
        $this->checkLogin();
        //$all_brand_product = DB::table('tbl_brand')->get(); static OOP
        
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get(); // Model
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);

        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function save_brand_product(BrandRequest $request)
    {
        $this->checkLogin();
        // $data = array();
        // $data['brand_name'] = $request->input('brand_product_name');
        // $data['brand_desc'] = $request->input('brand_product_desc');
        // $data['brand_status'] = $request->input('brand_product_status');
        // $data['created_at'] = date('Y-m-d H:i:s');
        // DB::table('tbl_brand')->insert($data);
        $data = $request->all();

        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->created_at = date('Y-m-d H:i:s');

        $brand->save();

        return redirect()->route('admin.add_brand')->with('message','Added Success');
    }
    public function unactive_brand_product($id)
    {
        Brand::where('brand_id',$id)->update(['brand_status' => 0]);
        Session::put('active_message','Unactive brand successfully');
        return redirect()->route('admin.all_brand');
    }
    public function active_brand_product($id)
    {
        Brand::where('brand_id',$id)->update(['brand_status' => 1]);
        Session::put('active_message','Active brand successfully');
        return redirect()->route('admin.all_brand');
    }

    public function edit_brand_product($id)
    {
        $this->checkLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$id)->get();
        $edit_brand_product = Brand::where('brand_id',$id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request , $id)
    {
        // $data = array();
        // $data['brand_name'] = $request->input('brand_product_name');
        // $data['brand_desc'] = $request->input('brand_product_desc');
        // $data['updated_at'] = date('Y-m-d H:i:s');
        // DB::table('tbl_brand')->where('brand_id',$id)->update($data);

        $data = $request->all();

        $brand = Brand::find($id);
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->updated_at = date('Y-m-d H:i:s');

        $brand->save();

        return redirect()->route('admin.all_brand')->with('confirm_update','Update Successful');
    }
    public function delete_brand_product($id)
    {
        Brand::where('brand_id',$id)->delete();

        return redirect()->route('admin.all_brand')->with('confirm_delete','Delete Successful');
    }

    //Frontend 
    public function show_brand($id)
    {
        $cate_product = Category::where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','asc')->get();
        
        $brand_name = Brand::where('tbl_brand.brand_id',$id)->get();

        $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
        ->where('tbl_brand.brand_id',$id)->get();
        
        return view('pages.brand.show_brand')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_name',$brand_name);
    }
}
