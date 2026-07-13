<?php

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Medical Store</h1>
    <form action="{{ route('medical_stores.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>License Number</label>
            <input type="text" name="license_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('medical_stores.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection