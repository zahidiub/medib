@extends('layouts.app')
@section('title', 'New Bill')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('bills.store') }}" method="POST">
            @csrf
            @include('bills._form')
            <button type="submit" class="btn btn-success">Save Bill</button>
            <a href="{{ route('bills.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    @include('bills._scripts')
@endsection
