@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Edit Intervention Record</h2>
        
        <form method="POST" action="{{ url("/intervention-records/{$interventionRecord->id}/update") }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="date_time_start">Date & Time:</label>
                <input type="datetime-local" id="date_time_start" name="date_time_start" 
                    value="{{ old('date_time_start', $interventionRecord->date_time_start) }}" required>
                @error('date_time_start')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address', $interventionRecord->address) }}" required>
                @error('address')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary">Summary:</label>
                <textarea id="summary" name="summary" rows="4" required>{{ old('summary', $interventionRecord->summary) }}</textarea>
                @error('summary')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_type_intervention">Intervention Type:</label>
                <select id="id_type_intervention" name="id_type_intervention" required>
                    <option value="">-- Select Intervention Type --</option>
                    @foreach($interventionTypes as $type)
                        <option value="{{ $type->id }}" {{ old('id_type_intervention', $interventionRecord->id_type_intervention) == $type->id ? 'selected' : '' }}>
                            {{ $type->no_intervention }} - {{ $type->description }}
                        </option>
                    @endforeach
                </select>
                @error('id_type_intervention')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_fire_station">Fire Station:</label>
                <select id="id_fire_station" name="id_fire_station" required>
                    <option value="">-- Select Fire Station --</option>
                    @foreach($fireStations as $station)
                        <option value="{{ $station->id }}" {{ old('id_fire_station', $interventionRecord->id_fire_station) == $station->id ? 'selected' : '' }}>
                            {{ $station->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_fire_station')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_captain">Assigned Captain (Optional):</label>
                <select id="id_captain" name="id_captain">
                    <option value="">-- Select Captain --</option>
                    @foreach($captains as $firefighter)
                        <option value="{{ $firefighter->id }}" {{ old('id_captain', $interventionRecord->id_captain) == $firefighter->id ? 'selected' : '' }}>
                            {{ $firefighter->prenom }} {{ $firefighter->nom }} - {{ $firefighter->grade->description }}
                        </option>
                    @endforeach
                </select>
                @error('id_captain')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Update Record</button>
                <a href="{{ url('/intervention-records') }}" class="btn btn-primary" style="text-decoration: none; padding: 0.5rem 1rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
