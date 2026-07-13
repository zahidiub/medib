@extends('layouts.app')
@section('title', 'Add Medicine')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('medicines.store') }}" method="POST">
            @csrf
            @include('medicines._form', ['medicine' => null])
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
