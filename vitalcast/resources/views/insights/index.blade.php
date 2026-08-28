<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - Campus Insights</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f4f4f9; }
        .dashboard { display: flex; gap: 20px; margin-top: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; width: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .btn-back { background: gray; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <a href="/home" class="btn-back">← Back to Dashboard</a>

    <h2>📊 Campus Health Insights</h2>
    <p>Anonymous, aggregated data from the VitalCast community.</p>
    

    <div class="dashboard">
        <div class="card">
            <h3>Campus Diet Quality</h3>
            <canvas id="dietChart"></canvas>
        </div>

        <div class="card">
            <h3>Average Sleep Distribution</h3>
            <canvas id="sleepChart"></canvas>
        </div>
    </div>

    <script>
        // Safely pass the PHP database data into JavaScript
        const rawDietData = @json($dietData);
        const rawSleepData = @json($sleepData);

        // --- 1. Render the Diet Pie Chart ---
        const dietCtx = document.getElementById('dietChart').getContext('2d');
        new Chart(dietCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(rawDietData), // e.g., ['Good', 'Average', 'Poor']
                datasets: [{
                    data: Object.values(rawDietData), // The actual counts
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336'] // Green, Yellow, Red
                }]
            }
        });

        // --- 2. Render the Sleep Bar Chart ---
        const sleepCtx = document.getElementById('sleepChart').getContext('2d');
        new Chart(sleepCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(rawSleepData).map(hours => hours + ' Hours'), 
                datasets: [{
                    label: 'Number of Students',
                    data: Object.values(rawSleepData),
                    backgroundColor: '#2196F3' // Blue
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    </script>
</body>
</html>