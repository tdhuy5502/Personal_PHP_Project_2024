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
            <h2>Thanks for ordered from us !</h2>
            <a class="btn btn-primary" href="{{route('frontend.home')}}">Continue your shopping</a>
        </div>
        
      
    </div>
</section> <!--/#cart_items-->
@endsection