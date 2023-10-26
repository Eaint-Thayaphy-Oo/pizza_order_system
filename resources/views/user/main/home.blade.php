@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        By Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="bg-dark text-white px-3 py-1 d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                            <hr>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}" class="text-dark">
                                <label class="" for="price-1">All</label>
                                {{-- <span class="badge border font-weight-normal">150</span> --}}
                            </a>
                        </div>
                        @foreach ($category as $c)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $c->id) }}" class="text-dark">
                                    <label class="" for="price-1">{{ $c->name }}</label>
                                    {{-- <span class="badge border font-weight-normal">150</span> --}}
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose One Option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 210px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>
                                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center shadow-sm fs-5 col-6 offset-3 py-5">There is no pizza <i
                                    class="fa-solid fa-pizza-slice ms-1"></i></p>
                        @endif
                    </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // alert('hello jquery');
            // $.ajax({
            //     type: 'get',
            //     url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
            //     data: {status: 'asc'},
            //     dataType: 'json',
            //     success: function(response) {
            //         console.log(response)
            //     }
            // })

            $('#sortingOption').change(function() {
                // console.log('this is changing');
                $eventOption = $('#sortingOption').val();
                // console.log($eventOption);
                if ($eventOption == 'asc') {
                    // console.log('first in first out');
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`)
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 210px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>
                                        {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    // console.log('last in first out');
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`)
                                $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 210px"
                                        src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="far fa-heart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-sync-alt"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}</h5>
                                        {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                            }
                            $('#dataList').html($list);
                        }
                    })
                }
            });
        });
    </script>
@endsection
