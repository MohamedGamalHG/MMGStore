<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>
  @include('Admin.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
   @include('Admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{--\Illuminate\Support\Facades\Request::segment(2) this to get the name in url like category ,filter....--}}
                        <h1 class="m-0">{{ strtoupper(\Illuminate\Support\Facades\Request::segment(2)) }}</h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                       @yield('content')


            </div>
        </section>
        <!-- /.content-header -->

        <!-- Main content -->

    </div>
</div>
<!-- ./wrapper -->
@include('Admin.footer')
</body>
</html>

