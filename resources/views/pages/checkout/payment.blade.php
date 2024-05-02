@extends('welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{route('frontend.home')}}">Return Home</a></li>
              <li class="active">Finish Order</li>
            </ol>
        </div><!--/breadcrums-->

       
        <div class="review-payment">
            <h2>Review Your Cart & Payment</h2>
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
        <h4 style="margin: 40px 0;font-size:20px" >Choose Payment Method</h4>
        <form action="{{route('frontend.order_confirm')}}" method="POST">
            @csrf
            <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Pay with ATM Card</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Cash on Delivered</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="checkbox"> Use Credit Card</label>
                </span>
                <input type="submit" style="margin-top: 0;color:#000" class="btn btn-primary" value="Confirm Order" name="send_order">
            </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection