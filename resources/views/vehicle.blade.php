@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Vehicles List</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <a href="#add-form" class="btn btn-success">+ Add New Vehicle</a>
            @if(count($vehicles) > 0)
                <form method="POST" action="{{ url('/vehicles/clear') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all vehicles?');">Clear All</button>
                </form>
            @endif
        </div>

        @if(count($vehicles) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identification #</th>
                        <th>License Plate</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Type</th>
                        <th>Fire Station</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->no_identification }}</td>
                            <td>{{ $vehicle->immatriculation }}</td>
                            <td>{{ $vehicle->marque }}</td>
                            <td>{{ $vehicle->modele }}</td>
                            <td>{{ $vehicle->annee_mise_en_service }}</td>
                            <td>{{ $vehicle->vehicleType->code }}</td>
                            <td>{{ $vehicle->fireStation->name }}</td>
                            <td>
                                <a href="{{ url("/vehicles/{$vehicle->id}/edit") }}" class="btn btn-warning" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form method="POST" action="{{ url("/vehicles/{$vehicle->id}/delete") }}" style="display: inline;">
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
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No vehicles yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Vehicle</h3>
        
        <form method="POST" action="{{ url('/vehicles/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="no_identification">Identification Number:</label>
                <input type="text" id="no_identification" name="no_identification" value="{{ old('no_identification') }}" required>
                @error('no_identification')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="immatriculation">License Plate:</label>
                <input type="text" id="immatriculation" name="immatriculation" value="{{ old('immatriculation') }}" required>
                @error('immatriculation')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="marque">Brand:</label>
                <input type="text" id="marque" name="marque" value="{{ old('marque') }}" required>
                @error('marque')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="modele">Model:</label>
                <input type="text" id="modele" name="modele" value="{{ old('modele') }}" required>
                @error('modele')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="annee_mise_en_service">Year of Service:</label>
                <input type="number" id="annee_mise_en_service" name="annee_mise_en_service" value="{{ old('annee_mise_en_service') }}" min="1900" max="{{ date('Y') }}" required>
                @error('annee_mise_en_service')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_type_vehicle">Vehicle Type:</label>
                <select id="id_type_vehicle" name="id_type_vehicle" required>
                    <option value="">-- Select Vehicle Type --</option>
                    @foreach(\App\Models\VehicleType::all() as $type)
                        <option value="{{ $type->id }}" {{ old('id_type_vehicle') == $type->id ? 'selected' : '' }}>{{ $type->code }} - {{ $type->description }}</option>
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
                    @foreach(\App\Models\FireStation::all() as $station)
                        <option value="{{ $station->id }}" {{ old('id_fire_station') == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
                @error('id_fire_station')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Vehicle</button>
        </form>
    </div>
@endsection
