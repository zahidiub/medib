@extends('layouts.app')
@section('title', 'Medical Stores')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Medical Stores</h5>
            <a href="{{ route('medical_stores.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add Medical Store
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>License No</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stores as $store)
                    <tr>
                        <td>{{ $store->name }}</td>
                        <td>{{ $store->license_no }}</td>
                        <td>{{ $store->address }}</td>
                        <td>{{ $store->phone }}</td>
                        <td class="text-end">
                            <a href="{{ route('medical_stores.show', $store) }}" class="btn btn-outline-secondary btn-sm">View</a>
                            <a href="{{ route('medical_stores.edit', $store) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <form action="{{ route('medical_stores.destroy', $store) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this store?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No medical stores yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
