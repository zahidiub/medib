@extends('layouts.app')
@section('title', 'Medicines')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Medicines</h5>
            <a href="{{ route('medicines.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add Medicine
            </a>
        </div>
        <form action="{{ route('medicines.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search medicine name..."
                       value="{{ $search ?? '' }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i> Search
                </button>
                @if(!empty($search))
                    <a href="{{ route('medicines.index') }}" class="btn btn-outline-danger">Clear</a>
                @endif
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:80px">#</th>
                        <th>Medicine Name</th>
                        <th>Unit Price</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicines as $medicine)
                    <tr>
                        <td>{{ $medicine->id }}</td>
                        <td>{{ $medicine->medicine_name }}</td>
                        <td>{{ number_format($medicine->unit_price, 2) }}</td>
                        <td class="text-end">
                            <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this medicine?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">
                        {{ !empty($search) ? 'No medicines match "'.$search.'".' : 'No medicines yet.' }}
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
