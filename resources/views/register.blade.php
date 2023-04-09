@extends('layouts.master')

@section('title', 'Register Page')

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username" value='{{ old('name') }}'>
                @error('name')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="UserEmail..." value='{{ old('email') }}'>
                @error('email')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="text" name="phone" placeholder="09****" value='{{ old('phone') }}'>
                @error('phone')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class=" form-control">
                    <option value="">Choose your gender..</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="Address..." value='{{ old('address') }}'>
                @error('address')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                @error('password')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirmation Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <p class=" text-danger fs-6">{{ $message }}</p>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#login') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
