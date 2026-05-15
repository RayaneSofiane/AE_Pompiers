@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Vehicle Types List</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <a href="#add-form" class="btn btn-success">+ Add New Vehicle Type</a>
            @if(count($vehicleTypes) > 0)
                <form method="POST" action="{{ url('/vehicle-types/clear') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all vehicle types?');">Clear All</button>
                </form>
            @endif
        </div>

        @if(count($vehicleTypes) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicleTypes as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->code }}</td>
                            <td>{{ $type->description }}</td>
                            <td>
                                <a href="{{ url("/vehicle-types/{$type->id}/edit") }}" class="btn btn-warning" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form method="POST" action="{{ url("/vehicle-types/{$type->id}/delete") }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No vehicle types yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Vehicle Type</h3>
        
        <form method="POST" action="{{ url('/vehicle-types/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}" required>
                @error('code')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Vehicle Type</button>
        </form>
    </div>
@endsection
