@extends('user.layout.main')

@section('content')
  <div class="container">
    <div class='mb-5'>
        @if( session('createSuccess'))
            <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                <div><i class="fa-solid fa-circle-check"></i>  {{ session('createSuccess') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="offset-1 col-5 d-flex align-items-center justify-content-center">
           <div class="m-3">
                <div class="fs-2 text-dark-50 fw-bolder">Hi there!</div>
                <div class="fs-5 text-secondary">I'm admin of this shop..what can I help you?</div>
                <div class="shadow-sm d-flex ms-3 my-2 mt-5">
                    <div class="p-3">
                        <i class="fa-brands fa-facebook me-4 fs-3 text-warning"></i>
                        <span>
                            message me at
                            <a href="https://web.facebook.com/htar.h.ei.754" class="text-warning text-decoration-none">Htar Htar Ei</a>
                        </span>
                    </div>
                </div>
                <div class="shadow-sm d-flex ms-3 my-2 ">
                    <div class="p-3">
                        <i class="fa-solid fa-envelope-open-text me-4 fs-3 text-warning"></i>
                        <span>
                            mail me at
                            <a href="" class="text-warning text-decoration-none">irisfleur@gmail.com</a>
                        </span>
                    </div>
                </div>
                <div class="shadow-sm d-flex ms-3 my-2 ">
                    <div class="p-3">
                        <i class="fa-brands fa-telegram me-4 fs-3 text-warning"></i>
                        <span>
                            Hi me at
                            <a href="" class="text-warning text-decoration-none">Iris Fleur</a>
                        </span>
                    </div>
                </div>
            <p class="mt-3 ms-3">Do u have any problem?Contact us</p>
           </div>
        </div>
        <div class="offset-1 col-4 shadow-sm">
            <div class="m-4 rounded-3">
                <form action="{{ route('user#getContactInfo') }}" method="post" class="mx-2">
                    @csrf
                    <input type="hidden" name="userId" value={{ Auth::user()->id }}>
                   <div class="my-3">
                        <label for="">Full Name</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Enter Your Full Name...." value="{{ old('name') }}">
                        @error('name')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                   </div>
                    <div class="my-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control" placeholder="Enter Your Email..." value="{{ old('email') }}">
                         @error('email')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label for="">Messages</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder="Write Something.."> {{ old('message') }}</textarea>
                         @error('message')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-warning">Send Messages</button>
                    <a href="{{ route('user#adminReplyPage') }}" class="ms-3">
                        <button type="button" class="btn btn-primary position-relative">
                            Admin Reply
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                             {{ count($replies) }}
                        </button>
                    </a>
                </form>
            </div>
        </div>
    </div>
  </div>
@endsection
