<?php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Medical Store</h1>
    <form action="{{ route('medical_stores.update', $medicalStore) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>License Number</label>
            <input type="text" name="license_number" class="form-control" value="{{ $medicalStore->license_number }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $medicalStore->name }}" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ $medicalStore->address }}" required>
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $medicalStore->phone_number }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('medical_stores.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection