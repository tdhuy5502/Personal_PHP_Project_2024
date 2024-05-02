@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('frontend.home')}}">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Image</td>
                        <td class="description">Description</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{ URL::to('/') }}/upload/products/{{$value->options->image}}" width="60" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>
                            <p>Product ID: {{$value->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($value->price)}} VND</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{route('frontend.update_cart_qty')}}" method="POST">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$value->qty}}" size="3">
                                    <input type="hidden" value="{{$value->rowId}}" name="rowId_cart" class="form-control">
                                    <input type="submit" value="Update Quantity" name="update_qty" class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $value->price * $value->qty;
                                    echo number_format($subtotal);
                                ?>
                             VND
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{route('frontend.delete_cart',['id'=>$value->rowId])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Total <span>{{ number_format(Cart::subtotal()) }} VND</span></li>
                        <li>Tax <span>{{ number_format(Cart::tax()) }} VND</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>{{ number_format(Cart::total()) }} VND</span></li>
                    </ul>
                    <?php
									$customer_id = Session::get('idCustomer');
									if(!empty($customer_id)){

								?>
                                    <a class="btn btn-default check_out" href="{{route('frontend.checkout')}}">Buy Now</a>
								<?php 
									}else{
									
								?>
								    <a class="btn btn-default check_out" href="{{route('frontend.login_check')}}">Buy Now</a>
								<?php 
									}
								?>
                       
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection