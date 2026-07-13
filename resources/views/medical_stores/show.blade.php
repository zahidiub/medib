<?php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Medical Store Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>License Number:</strong> {{ $medicalStore->license_number }}</li>
        <li class="list-group-item"><strong>Name:</strong> {{ $medicalStore->name }}</li>
        <li class="list-group-item"><strong>Address:</strong> {{ $medicalStore->address }}</li>
        <li class="list-group-item"><strong>Phone Number:</strong> {{ $medicalStore->phone_number }}</li>
    </ul>
    <a href="{{ route('medical_stores.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection