@extends('Customer.main')
@section('content')
<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border border">
                    <h3 class="bg-gray p-4">Register Now</h3>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach($errors->all()  as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{route('page.register_customer')}}" method="post">
                        @csrf
                        <fieldset class="p-4">
                            <input class="form-control mb-3" type="text" name="name" placeholder="UserName" required>
                            <input class="form-control mb-3" type="email" name="email" placeholder="Email*" required>
                            <input class="form-control mb-3" type="password" name="password" placeholder="Password*" required>
                            <input class="form-control mb-3" type="password" name="confirm_password" placeholder="Confirm Password*" required>
                            <div class="loggedin-forgot d-inline-flex my-3">
                                <input type="checkbox" id="registering" class="mt-1">
                                <label for="registering" class="px-2">By registering, you accept our <a class="text-primary font-weight-bold" href="terms-condition.html">Terms & Conditions</a></label>
                            </div>
                            <button type="submit" class="btn btn-primary font-weight-bold mt-3">Register Now</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
