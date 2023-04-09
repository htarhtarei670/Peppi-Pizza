@extends('admin.layouts.main')

@section('title','Role Change Page')

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
                            <form action="{{ route('admin#roleChangeProcess',$role->id) }} " method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                       <div class="">
                                            @if ($role->image==null && $role->gender=='female')
                                                <img src="{{ asset('admin/images/icon/user.webp') }}"  class="img-thumbnail" />

                                            @elseif ($role->image==null && $role->gender=='male')
                                                <img src="{{ asset('admin/images/icon/user-male.jpg') }}"  class="img-thumbnail" />
                                            @else
                                                <img src="{{ asset('storage/'.$role->image) }}"  />
                                            @endif
                                       </div>

                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12" type="submit"><i class="fa-solid fa-arrow-up-from-bracket pe-2 "></i>Change</button>
                                        </div>
                                    </div>
                                    <div class="col-5 offset-1">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('name',$role->name) }}"disabled>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if($role->role=='admin') selected @endif>Admin</option>
                                                <option value="user" @if($role->role=='user') selected @endif>User</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('email',$role->email) }}"disabled>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" value="{{ old('phone',$role->phone) }}"disabled>
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control"disabled>
                                                <option value="">Choose your gender</option>
                                                <option value="male" @if ($role->gender=='male') selected @endif>Male</option>
                                                <option value="female" @if ($role->gender=='female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="30" rows="2" class=" form-control @error('address') is-invalid @enderror" disabled>{{ old('address',$role->address) }}</textarea>
                                            @error('address')
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
