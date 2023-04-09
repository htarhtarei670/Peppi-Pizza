@extends('admin.layouts.main')

@section('title', 'Product List')

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
                                <h2 class="title-1">Product List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Products
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                <div class="mt-2">
                    @if( session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show col-4 offset-8" role="alert">
                            <div><i class="fa-solid fa-circle-xmark"></i>  {{ session('deleteSuccess') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if( session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-4 offset-8" role="alert">
                            <div><i class="fa-solid fa-circle-check"></i>  {{ session('updateSuccess') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

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
                        <div class="bg-white p-2 fs-5 text-center"><i class="fa-solid fa-database pe-2"></i> {{ $products->total() }}</div>
                    </div>
                </div>

                @if (count($products)!=0)
                 <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr class="">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Waiting Time</th>
                                <th>Category</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                                <tr class="tr-shadow">
                                    <td class=""><img src="{{asset('storage/'.$p->image)}}" style="width: 150px;height:100px" class=" img-thumbnail"></td>
                                    <td class="">{{ $p->name }}</td>
                                    <td class="">{{ $p->price }}kyats</td>
                                    <td class="">{{ $p->waiting_time }}min</td>
                                    <td class="">{{ $p->category_name }}</td>
                                    <td class=""><i class="fa-solid fa-eye"></i>  {{ $p->view_count }}</td>
                                    <td class="">
                                        <div class="table-data-feature">
                                           <a href="{{ route('product#detail',$p->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="See">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                           </a>
                                            <a href="{{ route('product#editPage',$p->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                           <a href="{{ route('product#delete',$p->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                           </a>

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
                   <div class="mt-2"> {{ $products->links() }}</div>
                    <!-- END DATA TABLE -->
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
