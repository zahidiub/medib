@extends('layouts.app')
@section('title', 'Bills')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Bills</h5>
            <a href="{{ route('bills.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> New Bill
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Receipt No</th>
                        <th>Date</th>
                        <th>Store</th>
                        <th>Patient</th>
                        <th>Total</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                    <tr>
                        <td>{{ $bill->receipt_no }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($bill->date)->format('d/m/Y') }}</td>
                        <td>{{ optional($bill->medicalStore)->name }}</td>
                        <td>{{ optional($bill->patient)->name }}</td>
                        <td>{{ number_format($bill->grossTotal(), 2) }}</td>
                        <td class="text-end">
                            <a href="{{ route('bills.preview', $bill) }}" class="btn btn-outline-success btn-sm" target="_blank">
                                <i class="bi bi-printer"></i> Print
                            </a>
                            <a href="{{ route('bills.show', $bill) }}" class="btn btn-outline-secondary btn-sm">View</a>
                            <a href="{{ route('bills.edit', $bill) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <form action="{{ route('bills.destroy', $bill) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this bill?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No bills yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
