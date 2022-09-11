<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <form >
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox"  class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>

                    </div>
                    @foreach(Price_Filter() as $price)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" wire:click="getFilterPrice({{$price->price}})"  class="custom-control-input" id="price-{{$price->price}}">
                        <label class="custom-control-label" for="price-{{$price->price}}">{{round($price->price)}}</label>
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                <form action="" method="" id="form-color">
                    @csrf
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="color-all">All Color</label>

                    </div>
                    {{-- hrer we make foreach for all subfilter and we make if statement to get just size from
                       filter name using with() relationship to access name from filter
                    --}}
                    @foreach(Sub_Filter() as $sub)
                        @if($sub->filter->name == 'Color')
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" wire:click="getFilterColor({{$sub->id}})" name="filter_color" value="{{$sub->id}}" class="check-color custom-control-input"  id="color-{{$sub->id}}">

                                <label class="custom-control-label" for="color-{{$sub->id}}">{{$sub->name}}</label>

                            </div>
                        @endif
                    @endforeach
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="size-all">
                        <label class="custom-control-label" for="size-all">All Size</label>

                    </div>
                    {{-- hrer we make foreach for all subfilter and we make if statement to get just size from
                        filter name using with() relationship to access name from filter
                     --}}
                    @foreach(Sub_Filter() as $sub)
                        @if($sub->filter->name == 'Size')
                            <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" wire:click="getFilterSize({{$sub->id}})" class="custom-control-input" id="size-{{$sub->id}}">
                                <label class="custom-control-label" for="size-{{$sub->id}}">{{$sub->name}}</label>

                            </div>
                        @endif
                    @endforeach
                </form>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div  class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        {{--here is the serach button and the sorted by --}}
                        {{--<form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name">
                                <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                </div>
                            </div>
                        </form>--}}
                     {{--   <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="#">Latest</a>
                                <a class="dropdown-item" href="#">Popularity</a>
                                <a class="dropdown-item" href="#">Best Rating</a>
                            </div>
                        </div>--}}
                    </div>
                </div>
                @if(!$mode)
                <div class="row" id="ajax_filter" >
                    @foreach($product as $pro)
                        <div  class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="{{asset('photos/'.$pro->id.'/'.$pro->images[0]->name)}}" alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{$pro->name}}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>{{$pro->price}}</h6><h6 class="text-muted ml-2"><del>{{$pro->price}}</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{route('shop-details',$pro->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <a href="{{route('add-cart',$pro->id)}}" id="add_to_cart" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <div class="row" id="from-filter" >
                        @foreach($producting as $pro)
                            {{--@foreach($pr->products as $pro)--}}
                            <div  class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{asset('photos/'.$pro->id.'/'.$pro->images[0]->name)}}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{$pro->name}}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{$pro->price}}</h6><h6 class="text-muted ml-2"><del>{{$pro->price}}</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{route('shop-details',$pro->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <a href="{{route('add-cart',$pro->id)}}" id="add_to_cart" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                            {{--@endforeach--}}
                        @endforeach
                    </div>
                @endif
                {{--<div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>--}}
            </div>
        </div>
        <!-- Shop Product End -->

    </div>
</div>
