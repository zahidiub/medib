@extends('layouts.app')
@section('title', 'Edit Medical Store')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('medical_stores.update', $medicalStore) }}" method="POST">
            @csrf @method('PUT')
            @include('medical_stores._form')
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('medical_stores.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
