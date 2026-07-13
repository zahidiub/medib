@extends('layouts.app')
@section('title', 'Patients')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Patients</h5>
            <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Add Patient
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width:80px">#</th>
                        <th>Name</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td class="text-end">
                            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete this patient?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-muted py-4">No patients yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
