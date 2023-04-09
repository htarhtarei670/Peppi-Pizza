@extends('admin.layouts.main')

@section('title', 'Order List')

@section('content')
    <!-- PAGE CONTAINER-->
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
                <div class="col-md-12">
                <h2 class="mb-3">Customer Messages</h2>
                 <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" id='dataTable'>
                        <thead>
                            <tr class="">
                                <th>Contact Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Sent Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($contactUsers as  $c )
                                <tr>
                                    <td class="text-center">{{ $c->id }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->message }}</td>
                                    <td>{{ $c->created_at->format('d-F-Y') }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                           <a href="{{ route('admin#contactMessageReplyPage',$c->id) }}" class="me-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="reply">
                                                    <i class="fa-solid fa-reply"></i>
                                                </button>
                                           </a>
                                            <a href="{{ route('admin#contactMessageDelete',$c->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="ban">
                                                    <i class="fa-solid fa-ban"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

