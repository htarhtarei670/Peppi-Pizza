@extends('admin.layouts.main')

@section('title','Product Detail Page')

@section('content')
 <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                           <div class="ms-3 mb-4 mt-2">
                                <i class="fa-solid fa-arrow-left-long" onclick="history.back()"></i>
                                {{-- <a href="{{ route('products#list') }}" class="text-dark"><i class="fa-solid fa-arrow-left-long"></i></a> --}}
                           </div>
                            <div class="col-3 offset-1">
                                <div class="user-img">
                                    <img src="{{ asset('storage/'.$detail->image) }}"  class="img-thumbnail" style="width:100%;height:200px"/>
                                </div>
                                <div class=''>
                                    <a href="{{ route('product#editPage',$detail->id) }}">
                                        <button class="btn btn-dark ms-2 my-2"><i class="fa-solid fa-pen-to-square pe-2"></i>Edit Pizza</button>
                                    </a>
                                </div>
                            </div>
                            <div class="col-7 ms-3">
                                <div class="">
                                    <h1 class="mb-4 mt-2 btn btn-info text-white d-block fs-2">{{ $detail->name }}</h1>
                                </div>
                                <div class="">
                                    <span class="btn btn-dark text-white"><i class="fa-solid fa-money-bill-wave me-2"></i>{{ $detail->price }}kyats</span>
                                    <span class="btn btn-dark text-white"><i class="fa-solid fa-hourglass-start me-2"></i>{{ $detail->waiting_time }}mins</span>
                                    <span class="btn btn-dark text-white"><i class="fa-solid fa-layer-group me-2"></i>{{ $detail->category_name }}</span>
                                    <span class="btn btn-dark text-white"><i class="fa-solid fa-eye me-2"></i>{{ $detail->view_count }}</span>
                                    <span class="btn btn-dark text-white mt-2"><i class="fa-solid fa-user-clock me-2"></i>{{ $detail->created_at->format(' D M Y') }}</span>
                                </div>
                                <div class="mt-3">
                                    <h4><i class="fa-solid fa-circle-info"></i> Detail</h4>
                                    <p class="pt-2">{{ $detail->description }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
