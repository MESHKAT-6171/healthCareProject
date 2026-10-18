<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment History - VitalCast</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
    <a href="{{ route('assessment.form') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center">
        &larr; Back to Assessment
    </a>
    <h1 class="text-2xl font-bold text-gray-800">Your Vitamin D Risk History</h1>
</div>

        @if($assessments->isEmpty())
            <div class="bg-white rounded-xl shadow p-8 text-center text-gray-500">
                <p>No assessment history found yet. Complete your first assessment to track your progress!</p>
                <a href="{{ route('assessment.form') }}" class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700">Start Assessment</a>
            </div>
        @else
            <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="p-4">Date</th>
                            <th class="p-4">BMI</th>
                            <th class="p-4">Diet</th>
                            <th class="p-4">Sun Exposure</th>
                            <th class="p-4">Risk Level</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($assessments as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-gray-600">{{ $item->created_at->format('M d, Y - H:i') }}</td>
                                <td class="p-4 text-gray-800 font-medium">{{ $item->bmi }}</td>
                                <td class="p-4 text-gray-600">{{ $item->diet_type }}</td>
                                <td class="p-4 text-gray-600">{{ $item->sun_exposure }}</td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        @if($item->risk_level == 'High') bg-red-100 text-red-700 
                                        @elseif($item->risk_level == 'Moderate') bg-yellow-100 text-yellow-700 
                                        @else bg-green-100 text-green-700 @endif">
                                        {{ $item->risk_level }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>