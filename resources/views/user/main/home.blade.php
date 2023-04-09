@extends('user.layout.main')

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by category</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 btn-dark p-2 mt-2">
                        <p class="pt-2" for="price-all">Categories</p>
                        <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                    </div>

                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('user#home') }}" class="text-dark text-decoration-none">
                            <p class="" for="price-1">All</p>
                        </a>
                    </div>

                    @foreach ($categories as $c)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('fliter#categories',$c->id) }}" class="text-dark text-decoration-none">
                                <p class="" for="price-1">{{ $c->name }}</p>
                            </a>
                        </div>
                    @endforeach

                </form>
            </div>
            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Price End -->

        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        {{-- cart --}}
                        <div>
                            <a href="{{ route('cart#list',Auth::user()->id) }}" class="text-decoration-none">
                                <button type="button" class="btn bg-dark text-white position-relative me-2">
                                    <i class="fa-solid fa-cart-plus pt-2 p-1"> </i>
                                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($carts) }}
                                  </span>
                                </button>
                            </a>
                            <a href="{{ route('cart#historyList') }}" class="text-decoration-none">
                                <button type="button" class="btn bg-dark text-white position-relative">
                                    <i class="fa-solid fa-clock-rotate-left pt-2 p-1"></i>History
                                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($order) }}
                                  </span>
                                </button>
                            </a>
                        </div>

                        {{-- sorting --}}
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortOption" class="form-control">
                                    <option value="">Choose Sorting...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id='pizzaCard'>
                    @if (count($products) !=0)
                        @foreach ($products as $p)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="pizza">
                                <a href="detail.html">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" style="height:250px">
                                            <div class="product-action">
                                                <a href="" class="btn btn-outline-dark btn-square">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                               <a href="{{ route('pizza#detail',$p->id) }}" class="btn btn-outline-dark btn-square">
                                                    <i class="fa-solid fa-circle-info"></i>
                                               </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}kyats </h5>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center bg-white shadow-sm col-8 offset-2 fs-1 p-4 mt-4">There is no pizza  <i class="fa-solid fa-pizza-slice"></i></p>
                    @endif
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $("#sortOption").change(function(){
                $sortingValue=$('#sortOption').val();

                 if($sortingValue== 'asc'){
                            $.ajax({
                                type:'get',
                                url:'/user/ajax/pizzaList',
                                data:{'status':'asc'},
                                dataType:'json',
                                success:function (response){
                                    $list='';
                                    for($i=0;$i<response.length;$i++){
                                        $list +=`
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                            <a href="detail.html">
                                                <div class="product-item bg-light mb-4">
                                                    <div class="product-img position-relative overflow-hidden">
                                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" style="height:250px">
                                                        <div class="product-action">
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="text-center py-4">
                                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h5>${response[$i].price}kyats </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        `
                                    }
                                    $('#pizzaCard').html($list);
                                },
                            });
                        }else if($sortingValue == 'desc'){
                            $.ajax({
                                type:'get',
                                url:'/user/ajax/pizzaList',
                                data:{'status':'desc'},
                                dataType:'json',
                                success:function (response){
                                    $list='';
                                    for($i=0;$i<response.length;$i++){
                                       $list+=`
                                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="pizza">
                                            <a href="detail.html">
                                                <div class="product-item bg-light mb-4">
                                                    <div class="product-img position-relative overflow-hidden">
                                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" style="height:250px">
                                                        <div class="product-action">
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="text-center py-4">
                                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h5>${response[$i].price}kyats </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                       `
                                    }
                                   $('#pizzaCard').html($list);
                                },
                            });
                }
            })
        });
    </script>

@endsection
