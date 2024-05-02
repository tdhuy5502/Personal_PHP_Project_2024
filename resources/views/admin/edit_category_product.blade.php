@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Selected Product's Category
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
                    @foreach($edit_category_product as $key => $edit_value)
                    <div class="position-center">
                        <form role="form" action="{{route('admin.update_category_product',['id' => $edit_value->category_id])}}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input name="category_product_name" value="{{ $edit_value->category_name }}" type="text" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>
                            <textarea style="resize: none" rows="7" name="category_product_desc" type="text" class="form-control" id="exampleInputPassword1">{{ $edit_value->category_desc }}</textarea>
                        </div>
                        
                        <button name="update_category_product" type="submit" class="btn btn-info">Confirm Update</button>
                    </form>
                    </div>
                @endforeach
                </div>
            </section>

    </div>

</div>
@endsection