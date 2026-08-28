<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Assessment Result - VitalCast</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl p-8 text-center border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-600 mb-2">Prediction Analysis</h2>
        
        <div class="my-6">
            <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ $status === 'Deficient Risk' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                {{ $status }}
            </span>
            <div class="text-4xl font-extrabold text-gray-900 mt-4">
                {{ $risk_score }}%
            </div>
            <p class="text-xs text-gray-500 mt-1">Calculated Deficiency Probability</p>
        </div>

        <div class="text-left bg-gray-50 p-4 rounded-xl text-sm text-gray-600 mb-6">
            <p><strong>Note:</strong> This assessment was generated using our 8-feature Random Forest ML model served via FastAPI.</p>
        </div>

        <a href="{{ route('assessment.form') }}" class="inline-block w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition duration-200 shadow-md">
            Run Another Assessment
        </a>
    </div>
</body>
</html>