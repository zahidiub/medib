<?php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Medical Stores</h1>
    <a href="{{ route('medical_stores.create') }}" class="btn btn-primary mb-3">Add Medical Store</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>License Number</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
            <tr>
                <td>{{ $store->license_number }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->address }}</td>
                <td>{{ $store->phone_number }}</td>
                <td>
                    <a href="{{ route('medical_stores.show', $store) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('medical_stores.edit', $store) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('medical_stores.destroy', $store) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection