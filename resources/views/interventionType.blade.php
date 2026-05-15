@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Intervention Types List</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <a href="#add-form" class="btn btn-success">+ Add New Intervention Type</a>
            @if(count($interventionTypes) > 0)
                <form method="POST" action="{{ url('/intervention-types/clear') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all intervention types?');">Clear All</button>
                </form>
            @endif
        </div>

        @if(count($interventionTypes) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Intervention Number</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($interventionTypes as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->no_intervention }}</td>
                            <td>{{ $type->description }}</td>
                            <td>
                                <a href="{{ url("/intervention-types/{$type->id}/edit") }}" class="btn btn-warning" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Edit</a>
                                <form method="POST" action="{{ url("/intervention-types/{$type->id}/delete") }}" style="display: inline;">
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
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No intervention types yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Intervention Type</h3>
        
        <form method="POST" action="{{ url('/intervention-types/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="no_intervention">Intervention Number:</label>
                <input type="text" id="no_intervention" name="no_intervention" value="{{ old('no_intervention') }}" required>
                @error('no_intervention')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Intervention Type</button>
        </form>
    </div>
@endsection
