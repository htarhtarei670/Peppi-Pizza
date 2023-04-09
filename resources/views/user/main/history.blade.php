@extends('user.layout.main')

@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 400px">
                <table class="table table-light table-borderless table-hover text-center mb-0 data-table" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($orders as $o)
                            <tr>
                                <td>{{ $o->created_at->format('F-d-y') }}</td>
                                <td>{{ $o->order_code }}</td>
                                <td>{{ $o->total_price }}kyats</td>
                                {{-- <td>{{ $o->status}}</td> --}}
                                <td>
                                    @if ($o->status=='0')
                                        <span class="text-warning"><i class="fa-regular fa-clock"></i> pending...</span>
                                    @elseif ($o->status=='1')
                                        <span class="text-success"><i class="fa-solid fa-check"></i> success</span>
                                    @elseif ($o->status=='2')
                                        <span class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-3">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
<!-- Cart End -->
@endsection
