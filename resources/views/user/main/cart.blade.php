@extends('user.layout.main')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0 data-table" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $c)
                        <tr >
                            <td class="align-middle"><img src="{{asset('storage/'.$c->product_image) }}" style="width:70px;height:60px" class=" img-thumbnail shadow-sm"></td>
                            <td class="align-middle">{{ $c->product_name }}</td>
                            <td class="align-middle" id='price'>{{ $c->product_price }}kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    {{-- hidden input area --}}
                                    {{-- <input type="hidden" name="" value="{{ $c->product_price }} " class="price"> --}}
                                    <input type="hidden" name="" value="{{ $c->product_id }}" class='productId'>
                                    <input type="hidden" name="" value="{{ $c->id}}" class='orderId'>
                                    <input type="hidden" name="" value="{{ $c->user_id }}" id="userId">

                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-minus" id="btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>

                                    <input type="text" class="form-control form-control-sm border-0 text-center" value="{{ $c->quatity }}" id='qty'>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-warning btn-plus" id="btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{ $c->product_price * $c->quatity }} kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="fs-3 pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id='surPrice'>{{ $totalPrice }}kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery Fee</h6>
                        <h6 class="font-weight-medium">3000kyats</h6> 
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{ $totalPrice + 3000 }}kyats</h5>
                    </div>
                    <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="checkoutBtn">Proceed To Checkout</button>
                    <button class="btn btn-block btn-danger font-weight-bold  py-3" id="clearBtn">Clear All Order</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

@section('scriptSource')
    <script src="{{ asset('js/userCart.js') }}"></script>
    <script>
        $(document).ready(function(){
            //when checkout btn click
            $('#checkoutBtn').click(function(){
                $random = Math.floor((Math.random() * 100000000000));
                $orderList=[];

                $('#dataTable tbody tr').each(function(index,row){
                    $orderList.push({
                        'userId':$(row).find('#userId').val(),
                        'productId':$(row).find('.productId').val(),
                        'qty':$(row).find('#qty').val(),
                        'total':Number($(row).find('#total').text().replace('kyats','')),
                        'orderCode': 'POS'+$random

                    })
                })
                // console.log($orderList);

                $.ajax({
                        type:'get',
                        url:'/user/ajax/order/list',
                        data:Object.assign({}, $orderList),
                        dataType:'json',
                        success:function(response){
                            if(response.status==='true'){
                                window.location.href = "http://127.0.0.1:8000/user/homePage";
                            }
                        }
                })

            })

            $('#clearBtn').click(function(){
                $('#dataTable tbody tr').remove();

                $.ajax({
                    type:'get',
                    url:'/user/ajax/allCart',
                    dataType:'json',
                    success:function(){

                    }
                })
            })

        })
    </script>
@endsection
