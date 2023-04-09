@extends('user.layout.main')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="py-3 px-5 ms-2">
        <a href="{{ route('user#home') }}" class="text-dark text-decoration-none">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $products->image) }}" alt="Image"
                             style="height: 400px"   >
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $products->name }}</h3>
                    <div class="d-flex mb-3">
                        <i class="fa-solid fa-eye pe-1"></i> {{ $products->view_count +1}}
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $products->price }}</h3>
                    <p class="mb-4">{{ $products->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <input type="hidden" name="" id="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="" id="pizzaId" value="{{ $products->id }}">

                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>


                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id='count'>
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning px-3" id="addToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $pro)
                     <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/' . $pro->image) }}" style='height:280px'>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a href="{{ route('pizza#detail',$pro->id) }}" class="btn btn-outline-dark btn-square">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href=""></a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ $pro->name }}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small class="fa fa-star text-warning mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            // increase view count
            $productId=$('#pizzaId').val();
            $.ajax({
                type:'get',
                url:'/user/ajax/increase/view/count',
                data:{'productId':$productId},
                dataType:'json',

            })

            //add data to cart table
            $('#addToCart').click(function(){
                $source={
                    'userId':$('#userId').val(),
                    'pizzaId':$('#pizzaId').val(),
                    'productCount':$('#count').val(),
                }

               $.ajax({
                    type:'get',
                    url:'/user/ajax/cart',
                    data:$source,
                    dataType:'json',
                    success:function(response){
                        if(response.status =='success'){
                            window.location.href = '/user/homePage';//way to direct user home page in js
                        }
                    }
               })
            })


        })
    </script>
@endsection
