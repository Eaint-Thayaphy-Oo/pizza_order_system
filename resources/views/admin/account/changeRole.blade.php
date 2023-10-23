@extends('admin.layouts.master')

@section('title', 'Admin List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="ms-5">
                                        <a href="{{ route('admin#list') }}">
                                            <i class="fa-solid fa-arrow-left text-dark"></i>
                                        </a>
                                    </div>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Role</h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('admin#change', Auth::user()->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                @if ($account->image == null)
                                                    @if ($account->gender == 'male')
                                                        <img src="{{ asset('image/default_user.webp') }}" alt=""
                                                            class="img-thumbnail shadow-sm" />
                                                    @else
                                                        <img src="{{ asset('image/default_female.jpg') }}" alt=""
                                                            class="img-thumbnail shadow-sm" />
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        class="img-thumbnail shadow-sm">
                                                @endif
                                                <div class="mt-3">
                                                    <input type="file" name="image"
                                                        class="form-control @error('image') is-invalid
                                                    @enderror">
                                                    @error('image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn bg-dark text-white col-12" type="submit">
                                                        <i class="fa-solid fa-circle-chevron-right me-1"></i>Change
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $account->name) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Admin Name..." disabled>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Email</label>
                                                    <input id="cc-pament" name="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $account->email) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Admin Email..." disabled>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" name="phone" type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        value="{{ old('phone', $account->phone) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Admin Phone..." disabled>
                                                    @error('phone')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Gender</label>
                                                    <select name="gender" class="form-control" disabled>
                                                        <option value="{{ old('gender', $account->gender) }}">
                                                            {{ old('gender', $account->gender) }}
                                                        </option>
                                                        <option value="male" @if ($account->gender == 'male')  @endif>
                                                            Male
                                                        </option>
                                                        <option value="female" @if ($account->gender == 'female')  @endif>
                                                            Female
                                                        </option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Address</label>
                                                    <textarea id="cc-pament" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false" rows="4" cols="50" placeholder="Enter Admin Address..."
                                                        disabled>{{ old('address', $account->address) }}</textarea>
                                                    @error('address')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Role</label>
                                                    <select name="role" class="form-control">
                                                        <option
                                                            value="admin"@if ($account->role == 'admin') selected @endif>
                                                            Admin</option>
                                                        <option
                                                            value="user"@if ($account->role == 'user') selected @endif>
                                                            User</option>
                                                    </select>
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
