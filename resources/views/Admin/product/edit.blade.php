@extends('Admin.main')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('product.update','test')}}" method="post" enctype="multipart/form-data">
        @csrf
        {{method_field('put')}}
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" class="form-control" value="{{$product->name}}" name="product_name" id="exampleInputEmail1">

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Product Price</label>
            <input type="number" name="product_price" value="{{$product->price}}" class="form-control" id="exampleInputEmail1" >

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Product Quantity</label>
            <input type="number" name="product_quantity" value="{{$product->quantity}}" class="form-control" id="exampleInputEmail1" >

        </div>  <div class="form-group">
            <label for="exampleInputEmail1">Product Description</label>
            <input type="text" name="product_description" value="{{$product->description}}" class="form-control" id="exampleInputEmail1" >

        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Upload Images</label>
            <input type="file" name="photo[]" class="form-control-file" accept="image/*" multiple id="exampleFormControlFile1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select Filter</label>
            <select name="filter_size" class="form-control" id="exampleFormControlSelect1">
                @foreach($subfilter as $sub)
                    @if($sub->filter->name  == 'Size')
                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select Filter</label>
            <select name="filter_color" class="form-control" id="exampleFormControlSelect1">
                @foreach($subfilter as $sub)
                    @if($sub->filter->name  == 'Color')
                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Select Sub Category</label>
            <select name="sub_category" class="form-control" id="exampleFormControlSelect1">
                @foreach($subcategory as $sub)
                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
