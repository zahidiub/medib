@extends('layouts.app')
@section('title', 'Add Medical Store')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('medical_stores.store') }}" method="POST">
            @csrf
            @include('medical_stores._form', ['medicalStore' => null])
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('medical_stores.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
