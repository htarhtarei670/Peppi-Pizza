@extends('admin.layouts.main')
@section('title', 'Category List')

@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('cate#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    {{-- alert show --}}
                    @if( session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                            <div><i class="fa-solid fa-circle-xmark"></i>  {{ session('deleteSuccess') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if( session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-3 offset-9" role="alert">
                            <div><i class="fa-solid fa-circle-xmark"></i>  {{ session('updateSuccess') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- serach area --}}
                    <div class="row">
                        <div class="col-5">
                            <h3 class="mb-3">Search Key: <span class="text-primary">{{ request('searchKey') }}</span></h3>
                        </div>
                        <div class="col-3 offset-4">
                            <form action="{{ route('cate#list') }}" method="get">
                                <div class="d-flex">
                                    <input type="text" placeholder="Search.." name="searchKey" class="form-control" value="{{ request('searchKey') }}">
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-1 offset-10">
                            <div class="bg-white p-2 fs-5 text-center"><i class="fa-solid fa-database pe-2"></i> {{ $categories->total() }}</div>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th>Created Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('cate#edit',$category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <form action="{{ route('cate#delete',$category->id) }}" method="get">
                                                        @csrf
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="text-danger text-center pt-4">There is no category yet!Pls try to create</h3>
                    @endif
                   <div class="mt-3"> {{ $categories->links() }}</div>
                    <!-- END DATA TABLE -->
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
