@extends('admin.layouts.main')

@section('title','Account Detail Page')

@section('content')
 <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class='mb-5'>
                @if( session('deleteSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                        <div><i class="fa-solid fa-circle-check"></i>  {{ session('deleteSuccess') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 offset-3 shadow-sm bg-white rounded-3">
                <div class="p-4">
                    <form action="{{ route('admin#contactMessageReplyProcess') }}" method="post">
                        @csrf
                        <input type="hidden" name="">
                        <div class="my-3">
                            <label for="">User Id</label>
                            <input type="text" name="userId" id="" class="form-control " value="{{ $contactMessage->user_id }}">
                            @error('userId')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">User Name</label>
                            <input type="text" name="userName" id="" class="form-control " value="{{ $contactMessage->name }}">
                            @error('userName')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="my-3">
                            <label for="">User Email</label>
                            <input type="text" name="userEmail" id="" class="form-control " value="{{ $contactMessage->email }}">
                            @error('userEmail')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Customer Comment</label>
                            <textarea name="message" id="" cols="10" rows="5"class="form-control ">{{ $contactMessage->message }}</textarea>
                            @error('message')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label for="">Reply to Customer Comment</label>
                            <textarea name="reply" id="" cols="10" rows="5" class="form-control " placeholder="Enter to reply..."></textarea>
                            @error('reply')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning"><i class="fa-solid fa-reply me-2"></i>Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
