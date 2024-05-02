@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Product
                </header>
                <div class="panel-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('message'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                    @endif
                    <div class="position-center">
                        @foreach($edit_product as $key => $prod)
                        <form role="form" action="{{route('admin.update_product',['id' => $prod->product_id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input name="product_name" value="{{$prod->product_name}}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Image</label>
                            <input name="product_image" type="file" class="form-control" id="exampleInputEmail1">
                            <img src="{{ URL::to('/') }}/upload/products/{{$prod->product_image}}" height="70" width="70">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input name="product_price" value="{{$prod->product_price}}" type="text" class="form-control" id="exampleInputEmail1" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea style="resize: none" rows="7" name="product_desc" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description">{{$prod->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Content</label>
                            <textarea style="resize: none" rows="7" name="product_content" type="text" class="form-control" id="exampleInputPassword1" placeholder="Content">{{$prod->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Quantity</label>
                            <input name="product_quantity" value="{{$prod->product_quantity}}" type="number" class="form-control" id="exampleInputPassword1" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Brand</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $brand)
                                @if($brand->brand_id == $prod->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $cate)
                                @if($cate->category_id == $prod->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>   
                        
                        <button name="add_product" type="submit" class="btn btn-info">Confirm Update</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>

</div>
@endsection