@extends('admin.layouts.master')

@section('title', 'Order List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row my-2">
                            <div class="d-flex">
                                <form action="{{ route('admin#changeStatus') }}" method="get" class="col-5">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-database mr-2"></i>{{ count($order) }}
                                            </span>
                                        </div>
                                        <label for="" class="mt-2 me-3">Order Status</label>
                                        <select name="orderStatus" id="orderStatus" class="custom-select"
                                            id="inputGroupSelect02">
                                            <option value="">All</option>
                                            <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                            </option>
                                            <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept
                                            </option>
                                            <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                                            </option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit"
                                                class="btn btn-sm ms-3 bg-dark text-white input-group-text">
                                                <i class="fa-solid fa-magnifying-glass me-3"></i>Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#listInfo', $o->order_code) }}" class="text-primary">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>
                                        <td>{{ $o->total_price }}</td>
                                        <td>
                                            <select name="status" class="form-control statusChange" id="statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $order->links() }}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('sciptSource')
    <script>
        $(document).ready(function() {
            // console.log('hello');
            // $('#orderStatus').change(function() {
            //     // console.log('hi');
            //     $status = $('#orderStatus').val();
            //     // console.log($status);

            //     $.ajax({
            //         type: 'get',
            //         url: 'http://127.0.0.1:8000/order/ajax/status',
            //         data: {
            //             'status': $status,
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             // console.log(response);
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'August',
            //                     'September', 'October', 'November', 'December'
            //                 ];

            //                 $dbDate = new Date(response[$i].created_at);
            //                 // console.log($dbDate);
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" + $dbDate.getFullYear();

            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                     <select name="status" id="orderStatus" class="form-control col-2 statusChange">
        //                         <option value="0" selected>Pending</option>
        //                         <option value="1">Accept</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                     <select name="status" id="orderStatus" class="form-control col-2 statusChange">
        //                         <option value="0">Pending</option>
        //                         <option value="1" selected>Accept</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `;
            //                 } else if (response[$i].status == 2) {
            //                     $statusMessage = `
        //                     <select name="status" id="orderStatus" class="form-control col-2 statusChange">
        //                         <option value="0">Pending</option>
        //                         <option value="1">Accept</option>
        //                         <option value="2" selected>Reject</option>
        //                     </select>
        //                     `;
            //                 }

            //                 $list += `
        //                 <tr class="tr-shadow" style="margin-bottom:2px !important">
        //                     <input type="hidden" class="orderId" value="${response[$i].id}">
        //                     <td>${response[$i].user_id}</td>
        //                     <td>${response[$i].user_name}</td>
        //                     <td>${$finalDate}</td>
        //                     <td>${response[$i].order_code}</td>
        //                     <td>${response[$i].total_price}</td>
        //                     <td>${$statusMessage}</td>
        //                 </tr>
        //                 `;
            //             }
            //             $('#dataList').html($list);
            //         }
            //     });
            // });

            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                // console.log($orderId);

                $data = {
                    'orderId': $orderId,
                    'status': $currentStatus
                };
                // console.log($data);

                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/staus',
                    data: $data,
                    dataType: 'json',
                });
            });
        });
    </script>
@endsection
