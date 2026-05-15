<nav class="navbar">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 1.5rem;">🚒 Fire Station Manager</h1>
            <div style="display: flex; gap: 1rem;">
                <!-- Fire Stations -->
                <a href="{{ url('/fireStations') }}" class="btn btn-primary">Fire Stations</a>

                <!-- Grades -->
                <a href="{{ url('/grades') }}" class="btn btn-primary">Grades</a>

                <!-- Firefighters -->
                <a href="{{ url('/firefighters') }}" class="btn btn-primary">Firefighters</a>

                <!-- Intervention Types -->
                <a href="{{ url('/intervention-types') }}" class="btn btn-primary">Intervention Types</a>

                <!-- Intervention Records -->
                <a href="{{ url('/intervention-records') }}" class="btn btn-primary">Records</a>
            </div>
        </div>
    </div>
</nav>
