@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add Product's Brand
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
                        <form role="form" action="{{route('admin.save_brand_product')}}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Name</label>
                            <input name="brand_product_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea style="resize: none" rows="7" name="brand_product_desc" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Show more</label>
                            <select name="brand_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>
                        </div>
            
                        <button name="add_brand_product" type="submit" class="btn btn-info">Add</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>

</div>
@endsection