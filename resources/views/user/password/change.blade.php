@extends('user.layout.main')

@section('content')
    <div class="row">
         @if( session('changeSuccess'))
            <div class="alert alert-warning alert-dismissible fade show col-3 offset-7" role="alert">
                <div><i class="fa-solid fa-circle-check"></i>  {{ session('changeSuccess') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

         <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2 py-3">Change Password</h3>
                        <hr>
                    </div>
                    <form action="{{ route('user#changeProcess',Auth::user()->id) }}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                            <input id="cc-pament" name="oldPassword" type="password"
                                class="form-control @error('oldPassword') is-invalid @enderror"
                                aria-required="true" aria-invalid="false" placeholder="Enter old password...">
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
                                aria-required="true" aria-invalid="false" placeholder="Enter new password...">
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
                                aria-required="true" aria-invalid="false" placeholder="Enter confrim password...">
                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                <i class="fa-solid fa-key text-white pe-2"></i> <span id="payment-button-amount">Change Password</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
