@extends('admin.layouts.main')

@section('title','Account Detail Page')

@section('content')
 <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                @if( session('UpdateAccoutSuccess'))
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-7" role="alert">
                        <div><i class="fa-solid fa-circle-check"></i> {{ session('UpdateAccoutSuccess') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 py-3">Account Info</h3>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-2">
                                <div class="user-img">
                                    @if (Auth::user()->image==null && Auth::user()->gender=='female')
                                        <img src="{{ asset('admin/images/icon/user.webp') }}"  class="img-thumbnail" />

                                    @elseif (Auth::user()->image==null && Auth::user()->gender=='male')
                                        <img src="{{ asset('admin/images/icon/user-male.jpg') }}"  class="img-thumbnail" />
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-5 offset-1">
                                <h5><i class="fa-solid fa-user-pen me-2 my-3 text-secondary"></i>{{ Auth::user()->name }}</h5>
                                <h5><i class="fa-solid fa-envelope me-2 my-3 text-primary"></i>{{ Auth::user()->email }}</h5>
                                <h5><i class="fa-solid fa-phone-volume me-2 my-3 "></i>{{ Auth::user()->phone }}</h5>
                                <h5><i class="fa-solid fa-address-card me-2 my-3 text-warning"></i>{{ Auth::user()->address }}</h5>
                                <h5><i class="fa-solid fa-user-clock me-2 my-3 text-danger"></i>{{ Auth::user()->created_at->format('d F Y') }}</h5>
                                <h5><i class="fa-solid fa-venus-mars me-2 my-3 text-success"></i>{{ Auth::user()->gender }}</h5>
                            </div>
                            <div class="col- offset-2">
                                <a href="{{ route('admin#edit') }}">
                                    <button class="btn btn-dark ms-2 my-2"><i class="fa-solid fa-pen-to-square pe-2"></i>Edit Profile</button>
                                </a>
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
