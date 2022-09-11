@extends('Admin.main')

@section('content')
    <!-- Button trigger modal -->
    <button type="button" style="margin-bottom: 10px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add {{\Illuminate\Support\Facades\Request::segment(2)}}
    </button>
    <button id="button1">Test</button>
    <!-- Modal -->
    @include('Admin.filter.add')

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
                    <th>Filter Name</th>
                    <th>Operations</th>
                </tr>
                </thead>

                <tbody>
                <?php $i=0;?>
                @foreach($filter as $fil)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$fil->name}}
                    </td>
                    <td>
                        <button  class="btn  btn-danger" data-bs-toggle="modal" data-bs-target="#Delete{{$fil->id}}">Delete</button>
                        <button class="btn  btn-success" data-bs-toggle="modal" data-bs-target="#Edit{{$fil->id}}"> Edit</button>
                    </td>
                </tr>
                @include('Admin.filter.edit')
                @include('Admin.filter.delete')
                @endforeach
                </tbody>

                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Filter Name</th>
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
        window.addEventListener('load',function (){
           /*var mod = document.getElementById('add_modal');
           console.log(mod);
           var first = document.getElementById('first_input');
           var inp = document.createElement('input');
           console.log('from script');
           mod.addEventListener('click',function (e){
              /!* console.log(e.target+ 'you are click add');
               first.appendChild(inp);*!/
               e.target.style.BackgroundColor = 'red';
           })*/
            var btn = document.getElementById('button1');
            btn.addEventListener('click',function (e){
                e.target.style.BackgroundColor = "red";
                alert('test');
            });
        });
    </script>
@endsection
