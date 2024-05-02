@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('frontend.home')}}">Return Home</a></li>
              <li class="active">Your Cart</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="register-req">
            <p>Please use Register or Login to order</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-15 clearfix">
                    <div class="bill-to">
                        <p>Customer Order Infomation</p>
                        <div class="form-one">
                            <form action="{{route('frontend.save_checkout_customer')}}" method="POST">
                                @csrf
                                <input name="shipping_email" type="text" placeholder="Email*">
                                
                                <input name="shipping_name" type="text" placeholder="Customer Name *">
                                <input name="shipping_address" type="text" placeholder="Address *">
                                <input name="shipping_phone" type="text" placeholder="Phone">
                                <textarea name="shipping_note"  placeholder="Note about your order here" rows="16"></textarea>
                                <input name="save_checkout_customer" type="submit" value="Confirm Order" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                        
                    </div>
                </div>
               				
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
@endsection