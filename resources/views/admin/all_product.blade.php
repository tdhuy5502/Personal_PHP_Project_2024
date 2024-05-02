@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        All Product Brand
      </div>
      <div class="row w2-res-tb">
        <div class="col-sm-5 m-b-xs">   
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          
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
                @if(Session::has('update_message'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('update_message') }}</p>
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
              <th>Product name</th>
              <th>Image</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Added Date</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($all_product as $key => $prod)
                <tr>
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td>{{ $prod->product_name }}</td>
                    <td><img src="{{ URL::to('/') }}/upload/products/{{$prod->product_image}}" height="70" width="70"></td>
                    <td>{{ $prod->category_name }}</td>
                    <td>{{ $prod->brand_name }}</td>
                    <td>{{ $prod->product_price }}</td>
                    <td>{{ $prod->product_quantity }}</td>
                    <td><span class="text-ellipsis">
                        <?php
                            if($prod->product_status == 0){
                            ?>
                                <a href="{{ route('admin.active_product',['id' => $prod->product_id])}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                            <?php
                            }else{
                                ?>
                                <a href="{{ route('admin.unactive_product',['id' => $prod->product_id])}}"><span class="fa fa-thumbs-up"></span></a>
                                <?php
                            }
                        ?>
                    </span></td>
                    <td><span class="text-ellipsis">{{ $prod->created_at }}</span></td>
                    <td>
                        <a href="{{ route('admin.edit_product',['id' => $prod->product_id])}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                        </a>
                        <a onclick="return confirm('Are you sure to delete this product ?')" href="{{ route('admin.delete_product',['id' => $prod->product_id])}}" class="active styling-delete" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </a>
                    </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
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