@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $c)
                            <tr>
                                <td><img src="{{ asset('storage/' . $c->pizza_image) }}" alt=""
                                        class="img thumbnail shadow-sm" style="width: 100px;"></td>
                                <td class="align-middle">{{ $c->pizza_name }}</td>
                                <td class="align-middle" id="price">{{ $c->pizza_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            id="qty" value="{{ $c->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $c->pizza_price * $c->qty }} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Deliver</h6>
                            <h6 class="font-weight-medium">3000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            //when + button click
            $('.btn-plus').click(function() {
                // console.log('plus');
                // console.log($(this).parents("tr"));
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').text().replace("kyats", " "));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;
                // console.log($total);
                $parentNode.find('#total').html(`${$total} kyats`);
                // console.log($price + " " + $qty);

                // console.log($price);
                // console.log($qty);

                summaryCalculation();
            });

            //when - button click
            $('.btn-minus').click(function() {
                // console.log('minus');
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').text().replace("kyats", " "));
                $qty = Number($parentNode.find('#qty').val());

                $total = $price * $qty;
                // console.log($total);
                $parentNode.find('#total').html($total + "kyats");

                summaryCalculation();
            });

            //when cross button click
            $('.btnRemove').click(function() {
                // console.log('remove');
                $parentNode = $(this).parents("tr");
                $parentNode.remove();

                summaryCalculation();
            });

            //calculate final price for order
            function summaryCalculation() {
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    // console.log(index + "|||" + row);
                    // console.log('row');
                    // console.log($(row).find('#total').text());
                    $totalPrice += Number($(row).find('#total').text().replace("kyats", ""));
                    // console.log($totalPrice);
                });

                $('#subTotalPrice').html(`${$totalPrice} kyats`);
                $('#finalPrice').html(`${$totalPrice+3000} kyats`);
            };
        });
    </script>
@endsection
