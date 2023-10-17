@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Info</h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-3 offset-2">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('image/default_user.webp') }}" alt=""
                                                    class="img-thumbnail shadow-sm" />
                                            @else
                                                <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                            @endif
                                        </div>
                                        <div class="col-5 offset-1">
                                            <h4 class="my-3"><i
                                                    class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}</h4>
                                            <h4 class="my-3"><i
                                                    class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                            <h4 class="my-3"><i
                                                    class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                            <h4 class="my-3"><i
                                                    class="fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}
                                            </h4>
                                            <h4 class="my-3"><i
                                                    class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 offset-2 mt-3">
                                            <button class="btn bg-dark text-white"><i
                                                    class="fa solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
