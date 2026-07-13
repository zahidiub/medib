@extends('layouts.app')
@section('title', 'Add Patient')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('patients.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
