@extends('Customer.main')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                    @foreach($carts as $cart)
                    <tr>
                        <td class="align-middle"><img src="{{asset('photos/'.$cart->src_image)}}" alt="" style="width: 50px;"> {{$cart->item}}</td>
                        <td class="align-middle">{{$cart->price}}</td>
                        <td class="align-middle">
                            <form method="post" action="{{route('item-add')}}">
                                @csrf
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                               {{-- <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>--}}
                                <input type="hidden" name="id" value="{{$cart->id}}">
                                <input type="number"  name="add_quantity" value="{{$cart->quantity}}" min="1" max="3" class="form-control form-control-sm bg-secondary text-center" >
                                {{--<div class=" input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>--}}


                            </div>
                            </form>
                        </td>
                        <td class="align-middle">{{$cart->price * $cart->quantity}}</td>
                        <td class="align-middle">
                        <form action="{{route('item-delete')}}" method="post" >
                            @csrf
                            {{method_field('Delete')}}
                            <input type="hidden" name="id" value="{{$cart->id}}">
                            <input type="submit" class="btn btn-sm btn-danger" value="X">
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{$real_price}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping & tax(.06)%</h6>
                            <h6 class="font-weight-medium">{{$real_price_tax}}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{$real_price_tax}}</h5>
                        </div>
                        <a href="{{route('checkout')}}" style="text-decoration: none;"><button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


@endsection
