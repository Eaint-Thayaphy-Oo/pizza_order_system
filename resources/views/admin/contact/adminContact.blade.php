@extends('admin.layouts.master')

@section('title', 'Contact List')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact List</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#list') }}" class="text-dark mb-3">
                            <i class="fa-solid fa-arrow-left-long"></i>Back
                        </a>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Contact ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Created date</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($contact as $c)
                                    <tr class="tr-shadow">
                                        <td>{{ $c->id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->email }}</td>
                                        <td class="col-2">{{ $c->message }}</td>
                                        <td>{{ $c->created_at->format('F-j-Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $contact->links() }}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
