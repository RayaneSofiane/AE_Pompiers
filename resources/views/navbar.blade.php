<nav class="navbar">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 1.5rem;">🚒 Gestionnaire de Casernes de Pompiers</h1>
            <div style="display: flex; gap: 1rem;">
                <!-- Casernes de Pompiers -->
                <a href="{{ url('/fireStations') }}" class="btn btn-primary">Casernes</a>

                <!-- Grades -->
                <a href="{{ url('/grades') }}" class="btn btn-primary">Grades</a>

                <!-- Pompiers -->
                <a href="{{ url('/firefighters') }}" class="btn btn-primary">Pompiers</a>

                <!-- Types d'Interventions -->
                <a href="{{ url('/intervention-types') }}" class="btn btn-primary">Types d'Interventions</a>

                <!-- Interventions -->
                <a href="{{ url('/intervention-records') }}" class="btn btn-primary">Interventions</a>

                <!-- Types de Véhicules -->
                <a href="{{ url('/vehicle-types') }}" class="btn btn-primary">Types de Véhicules</a>

                <!-- Véhicules -->
                <a href="{{ url('/vehicles') }}" class="btn btn-primary">Véhicules</a>
            </div>
        </div>
    </div>
</nav>
