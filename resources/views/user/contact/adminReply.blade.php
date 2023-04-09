@extends('user.layout.main')

@section('title','Admin Reply Page')

@section('content')
 <!-- MAIN CONTENT-->

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
             @if( session('createSuccess'))
                <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                    <div><i class="fa-solid fa-circle-check"></i>  {{ session('createSuccess') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-6 offset-3 shadow-sm bg-white rounded-3">
                <div class="p-4">
                    <form action="{{ route('user#adminReplyProcess') }}" method="post">
                        @csrf
                        <input type="hidden" name="">
                        @foreach ($adminReply as $a)
                            <input type="hidden" name="userId" value="{{ $a->id }}">
                            <input type="hidden" name="name" value="{{ $a->user_name }}">
                            <input type="hidden" name="email" value="{{ $a->user_email }}">
                            <div class="my-3">
                                <label for="">Admin Reply</label>
                                <textarea name="message" id="" cols="5" rows="3"class="form-control " disabled>{{ $a->reply }}</textarea>
                            </div>
                            <div class="my-3">
                                <label for="">Reply to Admin</label>
                                <textarea name="message" id="" cols="5" rows="3" class="form-control " placeholder="Enter to reply..."></textarea>
                                <div class="mt-2 float-right">
                                    <a href="{{ route('user#commentDelete',$a->id) }}" title="delete" class=" text-decoration-none">
                                        <button type='button' class="rounded"><i class="fa-regular fa-trash-can"></i></button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-warning mt-5"><i class="fa-solid fa-reply me-2"></i>Reply</button>
                        <a href="{{ route('user#contactUsPage') }}">
                            <button type="button" class="btn btn-warning mt-5"><i class="fa-solid fa-angles-left"></i> Back</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection

