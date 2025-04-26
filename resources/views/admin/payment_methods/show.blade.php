@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Payment Method Details</h6>
            <div>
                <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">ID</th>
                            <td>{{ $paymentMethod->id }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $paymentMethod->name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $paymentMethod->description ?? 'Not provided' }}</td>
                        </tr>
                        <tr>
                            <th>Instructions</th>
                            <td>{!! nl2br(e($paymentMethod->instructions)) ?? 'Not provided' !!}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($paymentMethod->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $paymentMethod->created_at->format('M d, Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $paymentMethod->updated_at->format('M d, Y H:i:s') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Logo
                        </div>
                        <div class="card-body text-center">
                            @if($paymentMethod->logo)
                                <img src="{{ asset($paymentMethod->logo) }}" alt="{{ $paymentMethod->name }}" class="img-fluid">
                            @else
                                <p>No logo uploaded</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment method?')">
                    <i class="fas fa-trash"></i> Delete Payment Method
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
