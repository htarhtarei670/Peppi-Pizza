@extends('admin.layouts.main')

@section('title', 'Order List')

@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                <h2>Order List</h2>
                {{-- <div class="row">
                    <div class="col-5">
                        <h3 class="mb-3">Search Key: <span class="text-primary">{{ request('searchKey') }}</span></h3>
                    </div>
                    <div class="col-3 offset-4">
                        <form action="{{ route('admin#orderList') }}" method="get">
                            <div class="d-flex">
                                <input type="text" placeholder="Search.." name="searchKey" class="form-control" value="{{ request('searchKey') }}">
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div> --}}

                {{-- <div class="row">
                    <div class="col-1 offset-10">

                    </div>
                </div> --}}

                <div class="mb-5">
                    <form action="{{ route('admin#orderSorting') }}" method="get" class="d-flex">
                        @csrf

                        <div class="input-group mb-3 mt-4">
                            <div class="bg-white p-2 fs-6 text-center input-group-text"><i class="fa-solid fa-database pe-2"></i>{{ count($order) }}</div>
                            <select name="status" id="statusSelect" class="col-2 form-select" id="inputGroupSelect01">
                                <option value=" ">All</option>
                                <option value="0" @if(request('status')=='0')selected @endif>Pending</option>
                                <option value="1" @if(request('status')=='1')selected @endif>Success</option>
                                <option value="2" @if(request('status')=='2')selected @endif>Reject</option>
                            </select>
                            <button class="btn btn-danger " type="submit"><i class="fa fa-search" ></i>search</button>
                        </div>
                    </form>
                </div>

                 <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2" id='dataTable'>
                        <thead>
                            <tr class="">
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr>
                               <input type="hidden" name="" class="orderId" value="{{ $o->id }}">
                                <td>{{ $o->user_id }}</td>
                                <td>{{ $o->user_name }}</td>
                                <td >{{ $o->created_at->format('F-d-Y') }}</td>
                                <td >
                                    <a href="{{ route('admin#orderInfo',$o->order_code) }}" class="text-danger">
                                        {{ $o->order_code }}
                                    </a>
                                </td>
                                <td>{{ $o->total_price}}Kyats</td>
                                <td>
                                    <select name="" class="form-control changeStatus">
                                        <option value="0" @if ($o->status== '0') selected @endif>Pending</option>
                                        <option value="1" @if ($o->status== '1') selected @endif>Success</option>
                                        <option value="2" @if ($o->status== '2') selected @endif>Reject</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                        {{-- <h3 class="text-danger text-center pt-4">There is no category yet!Pls try to create</h3> --}}

                   {{-- <div class="mt-2"> {{ $products->links() }}</div> --}}
                    <!-- END DATA TABLE -->
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){
            // $('#statusSelect').change(function(){
            //     $status=$('#statusSelect').val();

            //      $.ajax({
            //         type:'get',
            //         url:'http://127.0.0.1:8000/admin/order/orderSort',
            //         data:{'status':$status},
            //         dataType:'json',
            //         success:function(response){
            //            $list='';
            //            for($i=0;$i<response.length;$i++){

            //             // March-08-2023
            //             $dbDate =new Date(response[$i].created_at)
            //             $month=["January", "February", "March", "April", "May", "June",
            //               "July", "August", "September", "October", "November", "December"
            //             ];
            //             $finalDate=$month[$dbDate.getMonth()]+'-'+$dbDate.getDate()+'-'+$dbDate.getFullYear();

            //             //to select status
            //             if(response[$i].status == '0'){
            //                 $statusMessage=`
            //                 <select name="" class="form-control">
            //                     <option value="0" selected>Pending</option>
            //                     <option value="1">Success</option>
            //                     <option value="2" >Reject</option>
            //                 </select>
            //                 `
            //             }else if(response[$i].status =='1'){
            //                 $statusMessage=`
            //                 <select name="" class="form-control">
            //                     <option value="0">Pending</option>
            //                     <option value="1" selected>Success</option>
            //                     <option value="2" >Reject</option>
            //                 </select>
            //                 `
            //             }else if(response[$i].status == '2'){
            //                 $statusMessage=`
            //                 <select name="" class="form-control">
            //                     <option value="0">Pending</option>
            //                     <option value="1" >Success</option>
            //                     <option value="2" selected>Reject</option>
            //                 </select>
            //                 `
            //             }

            //             $list+=`
            //             <tr>
            //                 <td>${response[$i].user_id}</td>
            //                 <td>${response[$i].user_name}</td>
            //                 <td>${$finalDate}</td>
            //                 <td>${response[$i].order_code}</td>
            //                 <td>${response[$i].total_price}</td>
            //                 <td>${$statusMessage}</td>
            //             </tr>
            //             `
            //            }
            //            $('#dataList').html($list);
            //         }
            //     })
            // })

            $('.changeStatus').change(function(){
                $parentNode=$(this).parents("tr");
                $orderId=$parentNode.find('.orderId').val();
                $currentStatus=$parentNode.find('.changeStatus').val();
                $data={
                    'status':$currentStatus,
                    'orderId':$orderId,
                }

                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/admin/order/orderStatusChange',
                    data:$data,
                    dataType:'json',
                    success:function(){

                    }
                })
                location.reload();
            })
        })
    </script>
@endsection
