<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
    public function add_product()
    {   
        $this->checkLogin();
        $cate_product = Category::orderBy('category_id','desc')->get();
        $brand_product = Brand::orderBy('brand_id','desc')->get();
        
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function all_product()
    {
        $this->checkLogin();
        $all_product = Product::orderBy('product_id','DESC')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.product_id','desc')->get();

        $manager_product = view('admin.all_product')->with('all_product',$all_product);

        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(StoreProductRequest $request)
    {
        $data = $request->all();
        $product = new Product();

        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_quantity = $data['product_quantity'] ;
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_status = $data['product_status'];
        $product->created_at = date('Y-m-d H:i:s');

        
        $product->product_image = $data['product_image'];
        if(!empty($product->product_image)){
            $get_img_name = $product->product_image->getClientOriginalName();
            $name_img = current(explode('.',$get_img_name));
            $new_image = $name_img.rand(0,99).'.'.$product->product_image->getClientOriginalExtension();
            $product->product_image->move(public_path().'/upload/products/',$new_image);
            $product->product_image = $new_image;
            $product->save();
            return redirect()->route('admin.add_product')->with('message','Added Success');
        }
        $product->save();
        return redirect()->route('admin.add_product')->with('message','Added Success');
    }
    public function unactive_product($id)
    {
        Product::where('product_id',$id)->update(['product_status' => 0]);
        Session::put('active_message','Unactive brand successful');
        return redirect()->route('admin.all_product');
    }
    public function active_product($id)
    {
        Product::where('product_id',$id)->update(['product_status' => 1]);
        Session::put('active_message','Active brand successful');
        return redirect()->route('admin.all_product');
    }

    public function edit_product($id)
    {
        $this->checkLogin();
        $cate_product = Category::orderBy('category_id','desc')->get();
        $brand_product = Brand::orderBy('brand_id','desc')->get();
        
        $edit_product = Product::where('product_id',$id)->get();
        
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(StoreProductRequest $request, $id)
    {
        $data = $request->all();
        $product = Product::find($id);

        $product->product_name = $data['product_name'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->category_id = $data['product_cate'];
        $product->product_quantity = $data['product_quantity'];
        $product->brand_id = $data['product_brand'];
        $product->created_at = date('Y-m-d H:i:s');

        
        $product->product_image = $data['product_image'];
        if(!empty($product->product_image)){
            $get_img_name = $product->product_image->getClientOriginalName();
            $name_img = current(explode('.',$get_img_name));
            $new_image = $name_img.rand(0,99).'.'.$product->product_image->getClientOriginalExtension();
            $product->product_image->move(public_path().'/upload/products/',$new_image);
            $product->product_image = $new_image;
            $product->save();
            return redirect()->route('admin.all_product')->with('update_message','Updated Success');
        }
        $product->save();
        return redirect()->route('admin.all_product')->with('update_message','Updated Success');
    }
    public function delete_product($id)
    {
        Product::where('product_id',$id)->delete();

        return redirect()->route('admin.all_product')->with('confirm_delete','Delete Successful');
    }


    //Frontend Product
    public function product_detail($id)
    {
        $cate_product = Category::where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','desc')->get();

        $detail = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$id)->get();

        foreach($detail as $key => $item)
        {
            $cate_id = $item->category_id;
        }
        $related = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id',$cate_id)
        ->whereNotIn('tbl_product.product_id',[$id])->get();

        return view('pages.product.show_detail')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('detail_product',$detail)
        ->with('related_prod',$related);
    }
    public function show_products($id)
    {
        $cate_product = Category::where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','1')->orderBy('brand_id','desc')->get();

        $detail = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$id)->get();
        foreach($detail as $key => $item)
        {
            $cate_id = $item->category_id;
        }
        $related_prod = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id',$cate_id)
        ->whereNotIn('tbl_product.product_id',[$id])->get();
        $uniqueProducts = [];

        foreach($related_prod as $key => $item) {
            // Kiểm tra xem sản phẩm đã tồn tại trong mảng không
            if (!in_array($item->product_id, array_column($uniqueProducts, 'product_id'))) {
                // Thêm sản phẩm vào mảng các sản phẩm không trùng lặp
                $uniqueProducts[] = $item;
            }
        }

        return view('pages.product.show_detail')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('detail_product',$detail)
        ->with('related_prod',$related_prod)
        ->with(['uniqueProducts' => $uniqueProducts]);
    }
}
