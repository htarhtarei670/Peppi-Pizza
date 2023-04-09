@extends('admin.layouts.main')
@section('title','adminList')

@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="text-center mb-4">
                        <h1 class="title-1">Admin List</h1>
                    </div>

                    {{-- alert show --}}
                    @if( session('deleteSucess'))
                        <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                            <div><i class="fa-solid fa-circle-check"></i>  {{ session('deleteSucess') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if( session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-3 offset-9" role="alert">
                            <div><i class="fa-solid fa-circle-check"></i></i>  {{ session('updateSuccess') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif


                    {{-- serach area --}}
                    <div class="row">
                        <div class="col-5">
                            <h3 class="mb-3">Search Key: <span class="text-primary">{{ request('searchKey') }}</span></h3>
                        </div>
                        <div class="col-3 offset-4">
                            <form action="" method="get">
                                <div class="d-flex">
                                    <input type="text" placeholder="Search.." name="searchKey" class="form-control" value="{{ request('searchKey') }}">
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-1 offset-10">
                            <div class="bg-white p-2 fs-5 text-center"><i class="fa-solid fa-users-gear me-2"></i>{{ $admin->total() }} </div>
                        </div>
                    </div>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            <td>
                                                @if ($a->image==null)
                                                    @if ($a->gender=='female')
                                                        <img src="{{ asset('admin/images/icon/user.webp') }}" class=" img-thumbnail"  style="width: 130px;height:120px">
                                                    @else
                                                        <img src="{{ asset('admin/images/icon/user-male.jpg') }}" class=" img-thumbnail" style="width: 130px;height:120px">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.$a->image) }}" class=" img-thumbnail" style="width: 130px;height:120px">
                                                @endif
                                            </td>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ $a->email }}</td>
                                            <td>{{ $a->address }}</td>
                                            <td>{{ $a->phone }}</td>
                                            <td>{{ $a->gender }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                   {{-- <a href="@if ($a->id==Auth::user()->id)
                                                        #
                                                   @else
                                                         {{ route('admin#delete') }}
                                                   @endif">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                   </a> --}}

                                                        @if ($a->id==Auth::user()->id)

                                                        @else
                                                            <a href="{{ route('admin#roleChangePage',$a->id) }}" class="me-2">
                                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                                    title="Change admin role">
                                                                    <i class="fa-solid fa-person-circle-minus"></i>
                                                                </button>
                                                            </a>

                                                            <a href="{{ route('admin#delete',$a->id) }}">
                                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                                    title="Delete">
                                                                    <i class="fa-solid fa-trash-can p-3"></i>
                                                                </button>
                                                            </a>

                                                        @endif


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $admin->links() }}
                        </div>
                    <!-- END DATA TABLE -->
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

