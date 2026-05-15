@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Edit Firefighter</h2>
        
        <form method="POST" action="{{ url("/firefighters/{$firefighter->id}/update") }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" id="matricule" name="matricule" value="{{ old('matricule', $firefighter->matricule) }}" required>
                @error('matricule')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="prenom">First Name:</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $firefighter->prenom) }}" required>
                @error('prenom')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nom">Last Name:</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $firefighter->nom) }}" required>
                @error('nom')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_grade">Grade:</label>
                <select id="id_grade" name="id_grade" required>
                    <option value="">-- Select Grade --</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ old('id_grade', $firefighter->id_grade) == $grade->id ? 'selected' : '' }}>{{ $grade->description }}</option>
                    @endforeach
                </select>
                @error('id_grade')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_fire_station">Fire Station:</label>
                <select id="id_fire_station" name="id_fire_station" required>
                    <option value="">-- Select Fire Station --</option>
                    @foreach($fireStations as $station)
                        <option value="{{ $station->id }}" {{ old('id_fire_station', $firefighter->id_fire_station) == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
                @error('id_fire_station')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Update Firefighter</button>
                <a href="{{ url('/firefighters') }}" class="btn btn-primary" style="text-decoration: none; padding: 0.5rem 1rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
