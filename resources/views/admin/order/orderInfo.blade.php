@extends('admin.layouts.main')

@section('title', 'Order Info')

@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderSorting') }}" class="text-dark mb-3 ms-3">
                            <i class="fa-solid fa-arrow-left"></i>back
                        </a>

                        <div class="card  col-5 rounded-3">
                            <div class="card-body border-bottom">
                                <h3 class="fs-4"><i class="fa-solid fa-clipboard-list me-3"></i>Order Info</h3>
                                <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Fee</small>
                            </div>
                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col"><i class="fa-solid fa-user me-3"></i>Customer Name</div>
                                    <div class="col ms-4">{{ strtoupper($orderListData[0]->user_name) }}</div>
                                </div>
                                <div class="row my-2">
                                    <div class="col"><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                    <div class="col ms-4">{{ $orderListData[0]->order_code }}</div>
                                </div>
                                <div class="row my-2">
                                    <div class="col"><i class="fa-regular fa-calendar-days me-3"></i>Order Date</div>
                                    <div class="col ms-4">{{ $orderListData[0]->created_at->format('d-F-Y')}}</div>
                                </div>
                                <div class="row my-2">
                                    <div class="col"><i class="fa-solid fa-money-bill-wave me-3"></i>Total Amount</div>
                                    <div class="col ms-4">{{ $orderData->total_price }}kyats</div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-data2" id='dataTable'>
                            <thead>
                                <tr class="">
                                    <th></th>
                                    <th>Order Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quatity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderListData as $o)
                                    <tr>
                                        <td></td>
                                        <td>{{ $o->id }}</td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/' . $o->product_image) }}"
                                                style="width:150px;height:120px" class=" img-thumbnail shadow-sm">
                                        </td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('d-F-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }}kyats</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mt-3">{{ $orderData->links() }}</div> --}}
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
