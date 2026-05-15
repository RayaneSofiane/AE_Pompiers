@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Edit Vehicle Type</h2>
        
        <form method="POST" action="{{ url("/vehicle-types/{$vehicleType->id}/update") }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="code">Code:</label>
                <input type="text" id="code" name="code" value="{{ old('code', $vehicleType->code) }}" required>
                @error('code')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required>{{ old('description', $vehicleType->description) }}</textarea>
                @error('description')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Update Vehicle Type</button>
                <a href="{{ url('/vehicle-types') }}" class="btn btn-primary" style="text-decoration: none; padding: 0.5rem 1rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
