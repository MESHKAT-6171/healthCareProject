<!DOCTYPE html>
<html>
<body>
    <h2>Add New Health Log</h2>
    
    <form action="{{ route('logs.store') }}" method="POST">
        @csrf

        <div>
            <label>Name:</label><br>
            <input type="text" name="user_name" value="{{ old('user_name') }}">
            @error('user_name') <span style="color:red">{{ $message }}</span> @enderror
        </div><br>

        <div>
            <label>Sleep Hours (Last 24h):</label><br>
            <input type="number" name="sleep_hours" value="{{ old('sleep_hours') }}">
            @error('sleep_hours') <span style="color:red">{{ $message }}</span> @enderror
        </div><br>

        <div>
            <label>Diet Quality:</label><br>
            <select name="diet_quality">
                <option value="Good">Good</option>
                <option value="Average">Average</option>
                <option value="Poor">Poor</option>
            </select>
            @error('diet_quality') <span style="color:red">{{ $message }}</span> @enderror
        </div><br>

        <div>
            <label>Sunlight Exposure (Hours):</label><br>
            <input type="number" step="0.5" name="sunlight_hours" value="{{ old('sunlight_hours') }}">
            @error('sunlight_hours') <span style="color:red">{{ $message }}</span> @enderror
        </div><br>

        <div>
            <label>Water Intake (Liters):</label><br>
            <input type="number" step="0.1" name="water_liters" value="{{ old('water_liters') }}">
            @error('water_liters') <span style="color:red">{{ $message }}</span> @enderror
        </div><br>

        <div>
            <label>Stress Level (1-10):</label><br>
            <input type="number" name="stress_level" value="{{ old('stress_level') }}">
            @error('stress_level') <span style="color:red">{{ $message }}</span> @enderror
        </div><br>

        <button type="submit">Save Log</button>
    </form>
    <br>
    <a href="/home">Back to Dashboard</a>
     
</body>
</html>