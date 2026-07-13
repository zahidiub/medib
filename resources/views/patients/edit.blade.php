@extends('layouts.app')
@section('title', 'Edit Patient')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('patients.update', $patient) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
