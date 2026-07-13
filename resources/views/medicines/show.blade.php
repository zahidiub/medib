@extends('layouts.app')
@section('title', 'Medicine Details')

@section('content')
<div class="card">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>ID:</strong> {{ $medicine->id }}</li>
            <li class="list-group-item"><strong>Medicine Name:</strong> {{ $medicine->medicine_name }}</li>
            <li class="list-group-item"><strong>Unit Price:</strong> {{ number_format($medicine->unit_price, 2) }}</li>
        </ul>
        <a href="{{ route('medicines.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection
