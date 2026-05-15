@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Edit Vehicle</h2>
        
        <form method="POST" action="{{ url("/vehicles/{$vehicle->id}/update") }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="no_identification">Identification Number:</label>
                <input type="text" id="no_identification" name="no_identification" value="{{ old('no_identification', $vehicle->no_identification) }}" required>
                @error('no_identification')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="immatriculation">License Plate:</label>
                <input type="text" id="immatriculation" name="immatriculation" value="{{ old('immatriculation', $vehicle->immatriculation) }}" required>
                @error('immatriculation')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="marque">Brand:</label>
                <input type="text" id="marque" name="marque" value="{{ old('marque', $vehicle->marque) }}" required>
                @error('marque')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="modele">Model:</label>
                <input type="text" id="modele" name="modele" value="{{ old('modele', $vehicle->modele) }}" required>
                @error('modele')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="annee_mise_en_service">Year of Service:</label>
                <input type="number" id="annee_mise_en_service" name="annee_mise_en_service" value="{{ old('annee_mise_en_service', $vehicle->annee_mise_en_service) }}" min="1900" max="{{ date('Y') }}" required>
                @error('annee_mise_en_service')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_type_vehicle">Vehicle Type:</label>
                <select id="id_type_vehicle" name="id_type_vehicle" required>
                    <option value="">-- Select Vehicle Type --</option>
                    @foreach($vehicleTypes as $type)
                        <option value="{{ $type->id }}" {{ old('id_type_vehicle', $vehicle->id_type_vehicle) == $type->id ? 'selected' : '' }}>{{ $type->code }} - {{ $type->description }}</option>
                    @endforeach
                </select>
                @error('id_type_vehicle')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_fire_station">Fire Station:</label>
                <select id="id_fire_station" name="id_fire_station" required>
                    <option value="">-- Select Fire Station --</option>
                    @foreach($fireStations as $station)
                        <option value="{{ $station->id }}" {{ old('id_fire_station', $vehicle->id_fire_station) == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
                @error('id_fire_station')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-success">Update Vehicle</button>
                <a href="{{ url('/vehicles') }}" class="btn btn-primary" style="text-decoration: none; padding: 0.5rem 1rem;">Cancel</a>
            </div>
        </form>
    </div>
@endsection
