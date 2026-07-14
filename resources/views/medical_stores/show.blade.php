@extends('layouts.app')
@section('title', 'Medical Store Details')

@section('content')
<div class="card">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Name:</strong> {{ $medicalStore->name }}</li>
            <li class="list-group-item"><strong>Sub Name:</strong> {{ $medicalStore->sub_name }}</li>
            <li class="list-group-item"><strong>License No:</strong> {{ $medicalStore->license_no }}</li>
            <li class="list-group-item"><strong>Address:</strong> {{ $medicalStore->address }}</li>
            <li class="list-group-item"><strong>Phone:</strong> {{ $medicalStore->phone }}</li>
            <li class="list-group-item"><strong>Bottom Content:</strong><br><span style="white-space:pre-line">{{ $medicalStore->bottom_content }}</span></li>
        </ul>
        <a href="{{ route('medical_stores.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection
