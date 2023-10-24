@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ms-5">
                                                <a href="{{ route('user#home') }}">
                                                    <i class="fa-solid fa-arrow-left text-dark"></i>
                                                </a>
                                            </div>
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Change Password</h3>
                                            </div>
                                            <hr>

                                            @if (session('changeSuccess'))
                                                <div class="col-12">
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        <i
                                                            class="fa-solid fa-cloud-arrow-down me-2"></i>{{ session('changeSuccess') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (session('notMatch'))
                                                <div class="col-12">
                                                    <div class="alert alert-warning alert-dismissible fade show"
                                                        role="alert">
                                                        <i
                                                            class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('notMatch') }}
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                </div>
                                            @endif
                                            <form action="{{ route('user#changePassword') }}" method="post"
                                                novalidate="novalidate">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                                    <input id="cc-pament" name="oldPassword" type="password"
                                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Old Password...">
                                                    @error('oldPassword')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                                    <input id="cc-pament" name="newPassword" type="password"
                                                        class="form-control @error('newPassword') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter New Password...">
                                                    @error('newPassword')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Confirm
                                                        Password</label>
                                                    <input id="cc-pament" name="confirmPassword" type="password"
                                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Confirm Password...">
                                                    @error('confirmPassword')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit"
                                                        class="btn btn-lg bg-dark text-white btn-block">
                                                        <span id="payment-button-amount"><i
                                                                class="fa-solid fa-key me-2"></i>Change
                                                            Password</span>
                                                        <span id="payment-button-sending"
                                                            style="display:none;">Sending…</span>
                                                    </button>
                                                </div>
                                            </form>
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
