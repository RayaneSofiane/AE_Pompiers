@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Grades List</h2>
        
        <div style="margin-bottom: 1.5rem;">
            <a href="#add-form" class="btn btn-success">+ Add New Grade</a>
            @if(count($grades) > 0)
                <form method="POST" action="{{ url('/grades/clear') }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear all grades?');">Clear All</button>
                </form>
            @endif
        </div>

        @if(count($grades) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grades as $grade)
                        <tr>
                            <td>{{ $grade->id }}</td>
                            <td>{{ $grade->description }}</td>
                            <td>
                                <form method="POST" action="{{ url("/grades/{$grade->id}/delete") }}" style="display: inline;">
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
            <p style="text-align: center; color: #7f8c8d; padding: 2rem;">No grades yet. <a href="#add-form">Add one now!</a></p>
        @endif
    </div>

    <div class="card" id="add-form">
        <h3>Add New Grade</h3>
        
        <form method="POST" action="{{ url('/grades/add') }}">
            @csrf
            
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="{{ old('description') }}" required>
                @error('description')
                    <span style="color: #e74c3c; font-size: 0.85rem;">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Add Grade</button>
        </form>
    </div>
@endsection
