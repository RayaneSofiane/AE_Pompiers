@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Fire Stations List</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <a href="#add-form" class="btn btn-success">+ Add New Fire Station</a>
            @if(count($fireStations) > 0)
                <form method="POST" action="{{ url('/fireStations/clear') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all fire stations?');">Clear All</button>
                </form>
            @endif
        </div>

        @if(count($fireStations) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>State</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fireStations as $station)
                        <tr>
                            <td>{{ $station->id }}</td>
                            <td>{{ $station->name }}</td>
                            <td>{{ $station->address }}</td>
                            <td>{{ $station->city }}</td>
                            <td>{{ $station->phone }}</td>
                            <td>{{ $station->state->description }}</td>
                            <td>
                                <a href="{{ url("/fireStations/{$station->id}/edit") }}" class="btn btn-warning" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form method="POST" action="{{ url("/fireStations/{$station->id}/delete") }}" style="display: inline;">
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
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No fire stations yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Fire Station</h3>
        
        <form method="POST" action="{{ url('/fireStations/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
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
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                @error('city')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_state">State:</label>
                <select id="id_state" name="id_state" required>
                    <option value="">-- Select a State --</option>
                    @foreach(\App\Models\State::all() as $state)
                        <option value="{{ $state->id }}" {{ old('id_state') == $state->id ? 'selected' : '' }}>{{ $state->description }}</option>
                    @endforeach
                </select>
                @error('id_state')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Fire Station</button>
        </form>
    </div>
@endsection
