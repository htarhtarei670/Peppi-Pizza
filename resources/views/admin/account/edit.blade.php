@extends('admin.layouts.main')

@section('title','Account Detail Page')

@section('content')
 <!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 py-3">Account Profile</h3>
                            <hr>
                        </div>
                            <form action="{{ route('admin#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                       <div class="">
                                            @if (Auth::user()->image==null && Auth::user()->gender=='female')
                                                <img src="{{ asset('admin/images/icon/user.webp') }}"  class="img-thumbnail" />

                                            @elseif (Auth::user()->image==null && Auth::user()->gender=='male')
                                                <img src="{{ asset('admin/images/icon/user-male.jpg') }}"  class="img-thumbnail" />
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}"  />
                                            @endif
                                       </div>

                                        <div class="mt-3">
                                            <input type="file" name="image" id="" class='form-control' >
                                        </div>
                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12" type="submit"><i class="fa-solid fa-arrow-up-from-bracket pe-2 "></i>Updade</button>
                                        </div>
                                    </div>
                                    <div class="col-5 offset-1">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('name',Auth::user()->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('email',Auth::user()->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('phone',Auth::user()->phone) }}">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="">Choose your gender</option>
                                                <option value="male" @if (Auth::user()->gender=='male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender=='female') selected @endif>Femal</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="30" rows="2" class=" form-control @error('address') is-invalid @enderror" >{{ old('address',Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('role',Auth::user()->role) }}" disabled>
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
