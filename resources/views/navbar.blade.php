<nav class="navbar">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1 style="margin: 0; font-size: 1.5rem;">🚒 Fire Station Manager</h1>
            <div style="display: flex; gap: 1rem;">
                <!-- Fire Stations -->
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ url('/fireStations') }}" class="btn btn-primary">Fire Stations</a>
                    <a href="{{ url('/fireStations') }}" class="btn btn-success" style="margin-right: 0.5rem;">+ Add</a>
                </div>

                <!-- Grades -->
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ url('/grades') }}" class="btn btn-primary">Grades</a>
                    <a href="{{ url('/grades') }}" class="btn btn-success" style="margin-right: 0.5rem;">+ Add</a>
                </div>

                <!-- Firefighters -->
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ url('/firefighters') }}" class="btn btn-primary">Firefighters</a>
                    <a href="{{ url('/firefighters') }}" class="btn btn-success" style="margin-right: 0.5rem;">+ Add</a>
                </div>

                <!-- Intervention Types -->
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ url('/intervention-types') }}" class="btn btn-primary">Intervention Types</a>
                    <a href="{{ url('/intervention-types') }}" class="btn btn-success" style="margin-right: 0.5rem;">+ Add</a>
                </div>

                <!-- Intervention Records -->
                <div style="display: flex; gap: 0.5rem;">
                    <a href="{{ url('/intervention-records') }}" class="btn btn-primary">Records</a>
                    <a href="{{ url('/intervention-records') }}" class="btn btn-success">+ Add</a>
                </div>
            </div>
        </div>
    </div>
</nav>
