@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Firefighters List</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <div style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
                <div style="min-width: 250px;">
                    <label for="stationFilter" style="display: block; margin-bottom: 0.5rem; font-weight: bold;">Filter by Fire Station:</label>
                    <select id="stationFilter" onchange="window.location.href = this.value ? '{{ url('/firefighters') }}?fire_station_id=' + this.value : '{{ url('/firefighters') }}'" style="width: 100%; padding: 0.5rem; border: 2px solid #3498db; border-radius: 4px;">
                        <option value="">-- All Fire Stations --</option>
                        @foreach($fireStations as $station)
                            <option value="{{ $station->id }}" {{ $selectedStationId == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                        @endforeach
                    </select>
                </div>
                <a href="#add-form" class="btn btn-success">+ Add New Firefighter</a>
                @if(count($firefighters) > 0)
                    <form method="POST" action="{{ url('/firefighters/clear') }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all firefighters?');">Clear All</button>
                    </form>
                @endif
            </div>
        </div>

        @if(count($firefighters) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matricule</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Grade</th>
                        <th>Fire Station</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($firefighters as $firefighter)
                        <tr>
                            <td>{{ $firefighter->id }}</td>
                            <td>{{ $firefighter->matricule }}</td>
                            <td>{{ $firefighter->prenom }}</td>
                            <td>{{ $firefighter->nom }}</td>
                            <td>{{ $firefighter->grade->description }}</td>
                            <td>{{ $firefighter->fireStation->name }}</td>
                            <td>
                                <a href="{{ url("/firefighters/{$firefighter->id}/edit") }}" class="btn btn-warning" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form method="POST" action="{{ url("/firefighters/{$firefighter->id}/delete") }}" style="display: inline;">
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
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No firefighters yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Firefighter</h3>
        
        <form method="POST" action="{{ url('/firefighters/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="matricule">Matricule:</label>
                <input type="text" id="matricule" name="matricule" value="{{ old('matricule') }}" required>
                @error('matricule')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="prenom">First Name:</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                @error('prenom')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nom">Last Name:</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_grade">Grade:</label>
                <select id="id_grade" name="id_grade" required>
                    <option value="">-- Select Grade --</option>
                    @foreach(\App\Models\Grade::all() as $grade)
                        <option value="{{ $grade->id }}" {{ old('id_grade') == $grade->id ? 'selected' : '' }}>{{ $grade->description }}</option>
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
                    @foreach(\App\Models\FireStation::all() as $station)
                        <option value="{{ $station->id }}" {{ old('id_fire_station') == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
                @error('id_fire_station')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Firefighter</button>
        </form>
    </div>
@endsection
