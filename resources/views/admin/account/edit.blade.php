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
                                        <h3 class="text-center title-2">Account Profile</h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('image/default_user.webp') }}" alt=""
                                                        class="img-thumbnail shadow-sm" />
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        alt="" />
                                                @endif
                                                <div class="mt-3">
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn bg-dark text-white col-12" type="submit">
                                                        <i class="fa-solid fa-circle-chevron-right me-1"></i>Update
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', Auth::user()->name) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Admin Name...">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Email</label>
                                                    <input id="cc-pament" name="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', Auth::user()->email) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Admin Password...">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" name="phone" type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        value="{{ old('phone', Auth::user()->phone) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Admin Phone...">
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Gender</label>
                                                    <select name="gender" class="form-control">
                                                        <option value="{{ old('gender', Auth::user()->gender) }}">{{ old('gender', Auth::user()->gender) }}
                                                        </option>
                                                        <option value="male" @if (Auth::user()->gender == 'male')  @endif>Male
                                                        </option>
                                                        <option value="female" @if (Auth::user()->gender == 'female')  @endif>Female
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Address</label>
                                                    <textarea id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" rows="4" cols="50" placeholder="Enter Admin Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Role</label>
                                                    <input id="cc-pament" name="role" type="text"
                                                        class="form-control @error('role') is-invalid @enderror"
                                                        value="{{ old('role', Auth::user()->role) }}" disabled
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Admin Role...">
                                                    @error('role')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
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
@endsection
