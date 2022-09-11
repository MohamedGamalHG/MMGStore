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

    <div class="alert alert-success" id="alertsave" style="display:none;">data saved done</div>
    <form action="" method="post" id="ajaxform" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="exampleInputEmail1">

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Product Price</label>
            <input type="number" name="product_price" class="form-control" id="exampleInputEmail1" >

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Product Quantity</label>
            <input type="number" name="product_quantity" class="form-control" id="exampleInputEmail1" >

        </div>  <div class="form-group">
            <label for="exampleInputEmail1">Product Description</label>
            <input type="text" name="product_description" class="form-control" id="exampleInputEmail1" >

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
        <button id="ajax" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('js')

    <script>
        $(document).on('click','#ajax',function(e){
            e.preventDefault();
            var formdata = new FormData($('#ajaxform')[0]);
            $.ajax({
                type:'post',
                enctype:'multipart/form-data',
                url: "{{route('ajax.store')}}",
                data:formdata,
                processData: false,
                contentType: false,
                cache:false,
                success:function(data){
                        if(data.status == true)
                            $('#alertsave').show();
                },
                error:function(data){

                }
            })
        });
        </script>

@endsection

<!--

{
                    '_token':"{{csrf_token()}}",
                    'product_name' :$("input[name='product_name']").val(),
                    'product_price' :$("input[name='product_price']").val(),
                    'product_quantity' :$("input[name='product_quantity']").val(),
                    'product_description': $("input[name='product_description']").val(),
                    'sub_category': $("select[name='sub_category']").val(),

                }

 -->
