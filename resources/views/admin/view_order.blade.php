@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Customer's Detail
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer's Name</th>
              <th>Phone</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($order_by_id as $item)
                <tr>
                  <td>{{ $item->order_id }}</td>
                  <td>{{ $item->customer_name }}</td>
                  <td>{{ $item->customer_phone }}</td>    
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Order Shipping Detail
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer's Name</th>
              <th>Phone</th>
              <th>Address</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($order_by_id as $item)
                <tr>
                  <td>{{ $item->order_id }}</td>
                  <td>{{$item->shipping_name}}</td>
                  <td>{{$item->shipping_phone}}</td>
                  <td>{{$item->shipping_address}}</td>      
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
  <br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
          All Order Detail
        </div>
        <div class="row w3-res-tb">
          <div class="col-sm-5 m-b-xs">
                            
          </div>
          <div class="col-sm-4">
          </div>
          <div class="col-sm-3">
            <div class="input-group">
              
            </div>
          </div>
        </div>
        <div class="table-responsive">
                  @if(Session::has('active_message'))
                      <div class="alert alert-success">
                          <p>{{ Session::get('active_message') }}</p>
                      </div>
                  @endif
                  @if (Session::has('confirm_update'))
                  <div class="alert alert-success">
                      <p>{{ Session::get('confirm_update') }}</p>
                  </div>
                  @endif
                  @if (Session::has('confirm_delete'))
                  <div class="alert alert-success">
                      <p>{{ Session::get('confirm_delete') }}</p>
                  </div>
                  @endif
          <table class="table table-striped b-t b-light">
            <thead>
              <tr>
                <th style="width:20px;">
                  <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                  </label>
                </th>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Order Bill Paid(Including Tax)</th>
                <th style="width:30px;"></th>
              </tr>
            </thead>
            <tbody>
                @foreach($order_by_id as $item)
                  <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{$item->order_id}}</td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->product_sale_qty}}</td>    
                    <td>{{$item->product_price}}</td>
                    <td>{{$item->order_total}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <footer class="panel-footer">
          <div class="row">
            
            <div class="col-sm-5 text-center">
            </div>
            <div class="col-sm-7 text-right text-center-xs">                
              <ul class="pagination pagination-sm m-t-none m-b-none">
                <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                <li><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>
                <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
              </ul>
            </div>
          </div>
        </footer>
      </div>
</div>
  
@endsection