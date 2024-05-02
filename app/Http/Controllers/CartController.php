<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    //
    public function add_cart(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        $product_id = $request->input('prod_hidden_id');
        $quantity = $request->input('qty');

        $product_info =  DB::table('tbl_product')->where('product_id',$product_id)->first();
        //Cart::add('293ad', 'Product 1', 1, 9.99);
        //Cart::destroy();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        
        return redirect()->route('frontend.show_cart');
    }
    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function delete_cart($id)
    {
        Cart::update($id,'0');
        return redirect()->route('frontend.show_cart');
    }

    public function update_cart_qty(Request $request)
    {
        $rowId = $request->input('rowId_cart');
        $qty = $request->input('quantity');
        Cart::update($rowId,$qty);
        return redirect()->route('frontend.show_cart');
    }
}
