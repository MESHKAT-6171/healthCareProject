<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - My History</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 40px; background: #F3F4F6; color: #111827; }
        .container { max-width: 1000px; margin: auto; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; }
        .btn-success { background: #10B981; color: white; }
        .btn-back { background: #6B7280; color: white; }
        .btn-filter { background: #4F46E5; color: white; }
        .btn-clear { background: #FEE2E2; color: #EF4444; }

        /* The Filter Box */
        .filter-box { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; gap: 15px; align-items: flex-end; border: 1px solid #E5E7EB; }
        .filter-group { display: flex; flex-direction: column; gap: 5px; }
        .filter-group label { font-size: 14px; font-weight: bold; color: #4B5563; }
        .filter-group select, .filter-group input { padding: 10px; border: 1px solid #D1D5DB; border-radius: 6px; width: 150px; }

        /* The Data Table */
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #E5E7EB; }
        th { background: #F9FAFB; font-weight: bold; color: #4B5563; }
        tr:hover { background: #F9FAFB; }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="header">
            <div>
                <a href="/home" class="btn btn-back">← Dashboard</a>
                <h2 style="display: inline-block; margin-left: 15px;">My Health History</h2>
            </div>
            <a href="{{ route('logs.create') }}" class="btn btn-success">+ New Log</a>
        </div>

        @if(session('success'))
            <div style="background: #D1FAE5; color: #065F46; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <b>{{ session('success') }}</b>
            </div>
        @endif

        <form action="{{ route('logs.index') }}" method="GET" class="filter-box">
            
            <div class="filter-group">
                <label>Diet Quality</label>
                <select name="diet_quality">
                    <option value="">All Diets</option>
                    <option value="Good" {{ request('diet_quality') == 'Good' ? 'selected' : '' }}>Good</option>
                    <option value="Average" {{ request('diet_quality') == 'Average' ? 'selected' : '' }}>Average</option>
                    <option value="Poor" {{ request('diet_quality') == 'Poor' ? 'selected' : '' }}>Poor</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Exact Sleep Hours</label>
                <input type="number" name="sleep_hours" placeholder="e.g. 8" value="{{ request('sleep_hours') }}">
            </div>

            <button type="submit" class="btn btn-filter">🔍 Filter Data</button>
            
            @if(request()->has('diet_quality') || request()->has('sleep_hours'))
                <a href="{{ route('logs.index') }}" class="btn btn-clear">Clear Filters</a>
            @endif
        </form>

        <table>
            <tr>
                <th>Date</th>
                <th>Sleep (h)</th>
                <th>Diet</th>
                <th>Sunlight (h)</th>
                <th>Water (L)</th>
                <th>Stress (1-10)</th>
                <th>Action</th>
            </tr>
            
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('M d, Y') }}</td>
                <td>{{ $log->sleep_hours }}</td>
                <td>
                    @if($log->diet_quality == 'Good') 🟢 Good 
                    @elseif($log->diet_quality == 'Average') 🟡 Average 
                    @else 🔴 Poor @endif
                </td>
                <td>{{ $log->sunlight_hours }}</td>
                <td>{{ $log->water_liters }}</td>
                <td>{{ $log->stress_level }}</td>
                <td>
                    <form action="{{ route('logs.destroy', $log->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red; border: none; background: none; cursor: pointer; font-weight: bold;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        @if($logs->isEmpty())
            <div style="text-align: center; padding: 40px; color: #6B7280; background: white; border-radius: 0 0 12px 12px;">
                No health logs match your filter criteria.
            </div>
        @endif

    </div>

</body>
</html>