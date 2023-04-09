@extends('admin.layouts.main')

@section('title','change password page')

@section('content')
 <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 py-3">Change Password</h3>
                            <hr>
                        </div>

                            {{-- alert area --}}
                            @if (session('changeSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <div><i class="fa-solid fa-circle-check pe-2"></i>  {{ session('changeSuccess') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                             @if (session('changeFail'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div><i class="fa-solid fa-triangle-exclamation pe-2"></i>  {{ session('changeFail') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif


                        <form action="{{ route('admin#changePasswordProcess') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password"
                                    class="form-control @error('oldPassword') is-invalid @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="Enter your category...">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password"
                                    class="form-control @error('newPassword') is-invalid @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="Enter your category...">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password"
                                    class="form-control @error('confirmPassword') is-invalid @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="Enter your category...">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa-solid fa-key text-white pe-2"></i> <span id="payment-button-amount">Change Password</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
