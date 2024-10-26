@extends('layouts.appBack')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h3>Transport Options</h3>
        <a href="{{ route('transport-options.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Add New Transport Option
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th><i class="fas fa-car"></i> Name</th>
                <th><i class="fas fa-check-circle"></i> Availability</th>
                <th><i class="fas fa-leaf"></i> Carbon Footprint</th>
                <th><i class="fas fa-bus"></i> Type</th>
                <th><i class="fas fa-user-friends"></i> Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transportOptions as $option)
            <tr>
                <td class="text-center">{{ $option->name }}</td>
                <td class="text-center">{{ $option->disponibilité }}</td>
                <td class="text-center">{{ $option->carbon_empreinte }}</td>
                <td class="text-center">{{ $option->type }}</td>
                <td class="text-center">{{ $option->capacity }}</td>
                <td class="text-center">
                    <a href="{{ route('transport-options.edit', $option) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('transport-options.destroy', $option) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
