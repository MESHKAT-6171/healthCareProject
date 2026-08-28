<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - Admin Vault</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #222; color: white; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #444; padding-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #333; }
        th, td { border: 1px solid #555; padding: 10px; text-align: left; }
        th { background: #444; }
        .btn-export { background: #4CAF50; color: white; padding: 12px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn-back { background: #555; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <a href="/home" class="btn-back">← Back to App</a>
            <h2 style="display: inline-block; margin-left: 20px;">🛡️ Administrator Vault</h2>
        </div>

        <a href="{{ route('admin.export') }}" class="btn-export">📥 Download CSV </a>
    </div>

    <p>Warning: This page contains raw, un-anonymized data for all users.</p>

    <table>
        <tr>
            <th>ID</th><th>User</th><th>Sleep</th><th>Diet</th><th>Sunlight</th><th>Water</th><th>Stress</th><th>Date</th>
        </tr>
        @foreach ($allLogs as $log)
        <tr>
            <td>{{ $log->id }}</td>
            <td>{{ $log->user_name }}</td>
            <td>{{ $log->sleep_hours }}</td>
            <td>{{ $log->diet_quality }}</td>
            <td>{{ $log->sunlight_hours }}</td>
            <td>{{ $log->water_liters }}</td>
            <td>{{ $log->stress_level }}</td>
            <td>{{ $log->created_at->format('M d, Y') }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>