@extends('Admin.main')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" style="margin-bottom: 10px" class="btn btn-primary">
        <a style="color: white;text-decoration: none" href="{{route('ajax.show')}}">
            Add {{\Illuminate\Support\Facades\Request::segment(2)}}
        </a>

    </button>
    <button id="button1">Test</button>
    <!-- Modal -->

    <div class="alert alert-success" id="alertsave" style="display:none;">data saved done</div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">DataTable with default features</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Description</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                <?php $i=0;?>
                @foreach($product as $cat)
                <tr class="ajaxRow{{$cat->id}}">
                    <td>{{++$i}}</td>
                    <td>{{$cat->name}}
                    <td>{{$cat->price}}
                    <td>{{$cat->quantity}}
                    <td>{{$cat->description}}
                    </td>
                    <td>
                        <button  class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#Delete{{$cat->id}}">Delete</button>
                        <button class="btn  btn-success"><a href="{{route('product.edit',$cat->id)}}" style="text-decoration: none;color: white">Edit</a> </button>
                        {{--<form id="ajaxform"> @csrf {{method_field('delete')}}
                            <input type="hidden" name="id" value="{{$cat->id}}">
                            <button  class="btn  btn-danger" id="ajax" >Delete Ajax</button> </form>--}}
                        <a href="" ajax_id="{{$cat->id}}"  class="ajax btn btn-danger">Ajax delete</a>
                    </td>
                </tr>

                @include('Admin.product.delete')
                @endforeach
                </tbody>

                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Description</th>
                    <th>Operations</th>
                </tr>
                </tfoot>
            </table>
        </div>




        <!-- /.card-body -->
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click','.ajax',function (e){
            e.preventDefault();
            var ajax_id = $(this).attr('ajax_id');
            $.ajax({
                type:'post',
                url:"{{route('ajax.delete')}}",
                data:{
                    '_token':"{{csrf_token()}}",
                    'id' :  ajax_id  //$("input[name='id']").val()
                },
                success:function(data){
                    if(data.status == true)
                        $('#alertsave').show();
                    $('.ajaxRow'+data.id).remove();
                },
                error:function(data){

                }
            })
        })
    </script>
@endsection
