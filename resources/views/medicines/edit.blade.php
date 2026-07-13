@extends('layouts.app')
@section('title', 'Edit Medicine')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('medicines.update', $medicine) }}" method="POST">
            @csrf @method('PUT')
            @include('medicines._form')
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
