@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Edit Fire Station</h2>
        
        <form method="POST" action="{{ url("/fireStations/{$fireStation->id}/update") }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $fireStation->name) }}" required>
                @error('name')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address', $fireStation->address) }}" required>
                @error('address')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="{{ old('city', $fireStation->city) }}" required>
                @error('city')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone', $fireStation->phone) }}" required>
                @error('phone')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_state">State:</label>
                <select id="id_state" name="id_state" required>
                    <option value="">-- Select a State --</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}" {{ old('id_state', $fireStation->id_state) == $state->id ? 'selected' : '' }}>{{ $state->description }}</option>
                    @endforeach
                </select>
                @error('id_state')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Update Fire Station</button>
                <a href="{{ url('/fireStations') }}" class="btn btn-primary" style="text-decoration: none; padding: 0.5rem 1rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
