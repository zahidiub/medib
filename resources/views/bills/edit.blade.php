@extends('layouts.app')
@section('title', 'Edit Bill')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('bills.update', $bill) }}" method="POST">
            @csrf @method('PUT')
            @include('bills._form')
            <button type="submit" class="btn btn-success">Update Bill</button>
            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @include('bills._scripts')
@endsection
