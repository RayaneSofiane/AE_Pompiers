@extends('app')

@section('content')
    <div class="card">
        <h2 style="margin-top: 0;">Détails de l'Intervention</h2>
        
        <div style="background-color: #f9f9f9; padding: 1.5rem; border-radius: 4px;">
            <div style="margin-bottom: 1rem;">
                <strong>Numéro d'Intervention :</strong> {{ $interventionRecord->interventionType->no_intervention }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Type :</strong> {{ $interventionRecord->interventionType->description }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Date & Heure :</strong> {{ $interventionRecord->date_time_start }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Adresse :</strong> {{ $interventionRecord->address }}
            </div>
            
            <div style="margin-bottom: 1rem;">
                <strong>Caserne :</strong> {{ $interventionRecord->fireStation->name }}
            </div>
            
            @if($interventionRecord->captain)
                <div style="margin-bottom: 1rem;">
                    <strong>Capitaine Assigné :</strong> {{ $interventionRecord->captain->prenom }} {{ $interventionRecord->captain->nom }} ({{ $interventionRecord->captain->grade->description }})
                </div>
            @endif
            
            <div style="margin-bottom: 1rem;">
                <strong>Résumé :</strong>
                <div style="background-color: white; padding: 1rem; margin-top: 0.5rem; border-radius: 4px; border: 1px solid #ddd;">
                    {{ nl2br($interventionRecord->summary) }}
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <a href="{{ url(\"/intervention-records/{$interventionRecord->id}/edit\") }}" class="btn btn-warning">Modifier</a>
                <a href="{{ url('/intervention-records') }}" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>
@endsection
