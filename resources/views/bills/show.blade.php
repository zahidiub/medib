@extends('layouts.app')
@section('title', 'Bill Details')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h5 class="mb-1">Receipt #{{ $bill->receipt_no }}</h5>
                <div class="text-muted">{{ \Illuminate\Support\Carbon::parse($bill->date)->format('d/m/Y') }}</div>
            </div>
            <a href="{{ route('bills.preview', $bill) }}" class="btn btn-success" target="_blank">
                <i class="bi bi-printer"></i> Print Preview
            </a>
        </div>
        <hr>
        <p class="mb-1"><strong>Store:</strong> {{ optional($bill->medicalStore)->name }}</p>
        <p class="mb-0"><strong>Patient:</strong> {{ optional($bill->patient)->name }}</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th class="text-end">Qty</th>
                    <th class="text-end">Unit Price</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bill->billDetails as $detail)
                <tr>
                    <td>{{ optional($detail->medicine)->medicine_name }}</td>
                    <td class="text-end">{{ $detail->quantity }}</td>
                    <td class="text-end">{{ number_format($detail->unit_price, 2) }}</td>
                    <td class="text-end">{{ number_format($detail->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Gross Total</th>
                    <th class="text-end">{{ number_format($bill->grossTotal(), 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Discount</th>
                    <th class="text-end">{{ number_format($bill->discount, 2) }}</th>
                </tr>
                <tr>
                    <th colspan="3" class="text-end">Net Total</th>
                    <th class="text-end">{{ number_format($bill->netTotal(), 2) }}</th>
                </tr>
            </tfoot>
        </table>
        <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
