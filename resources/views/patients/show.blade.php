@extends('layouts.app')
@section('title', 'Patient Details')

@section('content')
<div class="card">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>ID:</strong> {{ $patient->id }}</li>
            <li class="list-group-item"><strong>Name:</strong> {{ $patient->name }}</li>
        </ul>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</div>
@endsection
