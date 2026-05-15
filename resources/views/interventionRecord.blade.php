@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Intervention Records</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <a href="#add-form" class="btn btn-success">+ Add New Intervention Record</a>
            @if(count($interventionRecords) > 0)
                <form method="POST" action="{{ url('/intervention-records/clear') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all records?');">Clear All</button>
                </form>
            @endif
        </div>

        @if($selectedFireStation)
            <div style="background-color: #e8f4f8; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">
                <p><strong>Filtering by Fire Station:</strong> {{ $selectedFireStation->name }}</p>
                <a href="{{ url('/intervention-records') }}" class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">View All</a>
            </div>
        @endif

        @if(count($interventionRecords) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date/Time</th>
                        <th>Address</th>
                        <th>Intervention Type</th>
                        <th>Fire Station</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($interventionRecords as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->date_time_start }}</td>
                            <td>{{ substr($record->address, 0, 30) }}...</td>
                            <td>{{ $record->interventionType->no_intervention }}</td>
                            <td>{{ $record->fireStation->name }}</td>
                            <td>
                                <a href="{{ url("/intervention-records/{$record->id}/view") }}" class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">View</a>
                                <a href="{{ url("/intervention-records/{$record->id}/edit") }}" class="btn btn-warning" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form method="POST" action="{{ url("/intervention-records/{$record->id}/delete") }}" style="display: inline;">
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
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No intervention records yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Intervention Record</h3>
        
        <form method="POST" action="{{ url('/intervention-records/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="date_time_start">Date & Time:</label>
                <input type="datetime-local" id="date_time_start" name="date_time_start" value="{{ old('date_time_start') }}" required>
                @error('date_time_start')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="summary">Summary:</label>
                <textarea id="summary" name="summary" rows="4" required>{{ old('summary') }}</textarea>
                @error('summary')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_type_intervention">Intervention Type:</label>
                <select id="id_type_intervention" name="id_type_intervention" required>
                    <option value="">-- Select Intervention Type --</option>
                    @foreach(\App\Models\InterventionType::all() as $type)
                        <option value="{{ $type->id }}" {{ old('id_type_intervention') == $type->id ? 'selected' : '' }}>{{ $type->no_intervention }} - {{ $type->description }}</option>
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
                        <option value="{{ $station->id }}" {{ old('id_fire_station') == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                    @endforeach
                </select>
                @error('id_fire_station')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Intervention Record</button>
        </form>
    </div>
@endsection
