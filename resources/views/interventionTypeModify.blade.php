@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Edit Intervention Type</h2>
        
        <form method="POST" action="{{ url("/intervention-types/{$interventionType->id}/update") }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="no_intervention">Intervention Number:</label>
                <input type="text" id="no_intervention" name="no_intervention" value="{{ old('no_intervention', $interventionType->no_intervention) }}" required>
                @error('no_intervention')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required>{{ old('description', $interventionType->description) }}</textarea>
                @error('description')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Update Intervention Type</button>
                <a href="{{ url('/intervention-types') }}" class="btn btn-primary" style="text-decoration: none; padding: 0.5rem 1rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
