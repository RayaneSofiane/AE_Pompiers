@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Intervention Record Details</h2>
        
        <div style="background-color: #f9f9f9; padding: 1.5rem; border-radius: 4px;">
            <div style="margin-bottom: 1rem;">
                <strong>Intervention Number:</strong> {{ $interventionRecord->interventionType->no_intervention }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Type:</strong> {{ $interventionRecord->interventionType->description }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Date & Time:</strong> {{ $interventionRecord->date_time_start }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Address:</strong> {{ $interventionRecord->address }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Fire Station:</strong> {{ $interventionRecord->fireStation->name }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Summary:</strong>
                <div style="background-color: white; padding: 1rem; margin-top: 0.5rem; border-radius: 4px; border: 1px solid #ddd;">
                    {{ nl2br($interventionRecord->summary) }}
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <a href="{{ url("/intervention-records/{$interventionRecord->id}/edit") }}" class="btn btn-warning">Edit</a>
                <a href="{{ url('/intervention-records') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
