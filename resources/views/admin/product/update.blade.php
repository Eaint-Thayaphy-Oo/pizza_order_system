@extends('admin.layouts.master')

@section('title', 'Product List')

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
                                        <a href="{{ route('product#list') }}">
                                            <i class="fa-solid fa-arrow-left text-dark"></i>
                                        </a>
                                    </div>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Update Pizza</h3>
                                    </div>
                                    <hr>

                                    @if (session('createSuccess'))
                                        <div class="col-4 offset-8">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-check"></i>{{ session('createSuccess') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    @if (session('deleteSuccess'))
                                        <div class="col-4 offset-8">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-check"></i>{{ session('deleteSuccess') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    @if (session('updateSuccess'))
                                        <div class="col-4 offset-8">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fa-solid fa-check"></i>{{ session('updateSuccess') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    <form action="{{ route('product#update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                                <img src="{{ asset('storage/' . $pizza->image) }}" alt="" />
                                                <div class="mt-3">
                                                    <input type="file" name="pizzaImage"
                                                        class="form-control @error('image') is-invalid
                                                    @enderror">
                                                    @error('pizzaImage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
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
                                                    <input id="cc-pament" name="pizzaName" type="text"
                                                        class="form-control @error('pizzaName') is-invalid @enderror"
                                                        value="{{ old('pizzaName', $pizza->name) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Name...">
                                                    @error('pizzaName')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                                    <select name="pizzaCategory" class="form-control">
                                                        @foreach ($category as $c)
                                                            <option value="{{ $c->id }}"
                                                                @if ($pizza->category_id == $c->id) selected @endif>
                                                                {{ $c->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                                    <textarea id="cc-pament" name="pizzaDescription" type="text"
                                                        class="form-control @error('pizzaDescription') is-invalid @enderror" aria-required="true" aria-invalid="false"
                                                        rows="4" cols="50" placeholder="Enter Description...">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                                    @error('pizzaDescription')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="pizzaPrice" type="text"
                                                        class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                        value="{{ old('pizzaPrice', $pizza->price) }}" aria-required="true"
                                                        aria-invalid="false" placeholder="Enter Price...">
                                                    @error('pizzaPrice')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Waiting
                                                        Time</label>
                                                    <input id="cc-pament" name="pizzaWaitingTime" type="text"
                                                        class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                        value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Enter Waiting Time...">
                                                    @error('pizzaWaitingTime')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">View Count</label>
                                                    <input id="cc-pament" name="pizzaViewCount" type="text"
                                                        class="form-control @error('pizzaViewCount') is-invalid @enderror"
                                                        value="{{ old('pizzaViewCount', $pizza->view_count) }}"
                                                        aria-required="true" aria-invalid="false" disabled
                                                        placeholder="Enter View Count...">
                                                    @error('pizzaViewCount')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="cc-payment" class="control-label mb-1">Created
                                                        Date</label>
                                                    <input id="cc-pament" name="pizzaCreatedDate" type="text"
                                                        class="form-control @error('pizzaCreatedDate') is-invalid @enderror"
                                                        value="{{ old('pizzaCreatedDate', $pizza->created_at->format('j_F_Y')) }}"
                                                        aria-required="true" aria-invalid="false" disabled
                                                        placeholder="Enter Created Date...">
                                                    @error('pizzaCreatedDate')
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
