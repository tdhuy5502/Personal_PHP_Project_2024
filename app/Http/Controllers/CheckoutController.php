<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontendLoginRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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
    public function login_check()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.login_check')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(FrontendLoginRequest $request)
    {
        $data = array();
        $data['customer_name'] = $request->input('customer_name');
        $data['customer_email'] = $request->input('customer_email');
        $data['customer_password'] = $request->input('customer_pass');
        $data['customer_phone'] = $request->input('customer_phone');
        $data['created_at'] = date('Y-m-d H:i:s');

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        $request->session()->put('idCustomer',$customer_id);
        $request->session()->put('nameCustomer',$request->input('customer_name'));

        return redirect()->route('frontend.checkout');
    }
    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->input('shipping_name');
        $data['shipping_email'] = $request->input('shipping_email');
        $data['shipping_note'] = $request->input('shipping_note');
        $data['shipping_address'] = $request->input('shipping_address');
        $data['shipping_phone'] = $request->input('shipping_phone');
        $data['created_at'] = date('Y-m-d H:i:s');

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        $request->session()->put('idShipping',$shipping_id);
        $request->session()->put('nameShipping',$request->input('shipping_name'));

        return redirect()->route('frontend.payment');
    }
    public function login(Request $request)
    {
        $email = $request->input('email_acc');
        $password = $request->input('password');
        
        $infoUser = DB::table('tbl_customer')->where([
            'customer_email' => $email,
            'customer_password' => $password
        ])->first();
        
        if(!empty($infoUser))
        {
            $request->session()->put('idCustomer',$infoUser->customer_id);
            $request->session()->put('emailCustomer',$infoUser->customer_email);
            $request->session()->put('passwordCustomer',$infoUser->customer_password);
            $request->session()->put('nameCustomer',$infoUser->customer_name);
            $request->session()->put('phoneCustomer',$infoUser->customer_phone);
            return redirect()->route('frontend.checkout');
        }
        else
        {
            return redirect()->back()->with('error_login','Sai ten dang nhap hoac tai khoan');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('idCustomer');
        $request->session()->forget('nameCustomer');
        return redirect()->route('frontend.home');
    }
    public function payment()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function order_confirm(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        //get payment method
        $data = array();
        $data['payment_method'] = $request->input('payment_option');
        $data['payment_status'] = 'On Queue';
        $data['created_at'] = date('Y-m-d H:i:s');

        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //get order
        $order = array();
        $order['customer_id'] = $request->session()->get('idCustomer');
        $order['shipping_id'] = $request->session()->get('idShipping');
        $order['payment_id'] = $payment_id;
        $order['order_total'] = Cart::total();
        $order['order_status'] = 'On Queue';
        $order['created_at'] = date('Y-m-d H:i:s');

        $order_id = DB::table('tbl_order')->insertGetId($order);

        //get order detail
        $content = Cart::content();
        foreach($content as $value)
        {
            $detail = array();
            $detail['order_id'] = $order_id;
            $detail['product_id'] = $value->id;
            $detail['product_name'] = $value->name;
            $detail['product_price'] = $value->price;
            $detail['product_sale_qty'] = $value->qty;
            $detail['created_at'] = date('Y-m-d H:i:s');    
            $detail = DB::table('tbl_detail')->insert($detail);
        }
        if($data['payment_method']==1)
        {
            echo 'Pay with ATM Card';
        }
        elseif($data['payment_method']==2)
        {
            Cart::destroy();
            
            return view('pages.checkout.handcash')
            ->with('category',$cate_product)->with('brand',$brand_product)
           ;
        }
        else
        {
            echo 'Pay with Credit Card';
        }

    }
    public function manage_order()
    {
        $this->checkLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderBy('tbl_order.order_id','desc')->get();

        $manager_order = view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }
    public function view_order($id)
    {
        $this->checkLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_detail','tbl_order.order_id','=','tbl_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_detail.*')->get();

        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);

        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);
    }
}
