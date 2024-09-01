@extends('layouts.light.master')
@section('title', 'Distributors')

@section('breadcrumb-title')
<h3>Distributors</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Distributors</li>
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-sm-12">
        <div class="card rounded-0 shadow-sm">
            <div class="card-header p-3">
                <div class="row px-3 justify-content-between align-items-center">
                    <div>All Distributors</div>
                    <a href="{{route('admin.distributors.create')}}" class="btn btn-sm btn-primary">New Distributor</a>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responive">
                    <table class="table table-bordered table-striped table-hover datatable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>Contact</th>
                                <th>Shop</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($distributors as $distributor)
                            <tr data-row-id="{{ $distributor->id }}">
                                <td>{{ $distributor->id }}</td>
                                <td>
                                    <img src="{{asset($distributor->photo)}}" alt="Photo" style="height: 150px; width: 150px;">
                                </td>
                                <td>
                                    <div>{{$distributor->full_name}}</div>
                                    <div>{{$distributor->email}}</div>
                                    <div>{{$distributor->phone}}</div>
                                </td>
                                <td>
                                    <div>{{$distributor->shop_name}}</div>
                                    <div>{{$distributor->type}}</div>
                                </td>
                                <td>{{$distributor->address}}</td>
                                <td width="50">
                                    <x-form action="{{ route('admin.distributors.destroy', $distributor) }}" method="delete">
                                        <div class="btn-group btn-group-inline">
                                            <a class="btn btn-sm btn-primary" target="_blank" href="{{ route('admin.distributors.edit', $distributor) }}">Edit</a>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </div>
                                    </x-form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
