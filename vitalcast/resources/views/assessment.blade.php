<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitamin D Assessment - VitalCast</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        
        <!-- Back to Home Button -->
        <a href="/home" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 mb-6 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Dashboard
        </a>

        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Vitamin D Risk Assessment</h2>

        @if($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 text-sm">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('assessment.submit') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                    <input type="number" name="age" required min="1" max="120" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">BMI</label>
                    <input type="number" step="0.1" name="bmi" required min="10" max="60" class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Typical Diet</label>
                    <select name="diet_type" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="Omnivore">Omnivore (Meat & Plants)</option>
                        <option value="Vegetarian">Vegetarian (No Meat, but Dairy/Eggs)</option>
                        <option value="Vegan">Vegan (Strictly Plant-Based)</option>
                        <option value="Pescatarian">Pescatarian (Fish & Plants)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Weekly Sun Exposure</label>
                    <select name="sun_exposure" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="Low">Low (Mostly indoors)</option>
                        <option value="Moderate">Moderate (Regular outdoor activities)</option>
                        <option value="High">High (Outdoor work / extensive sun)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Geographic Region</label>
                    <select name="latitude_region" required class="w-full rounded-md border border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none">
                        <option value="Low">Equatorial / Tropical</option>
                        <option value="Mid">Mid-Latitudes (e.g., Bangladesh)</option>
                        <option value="High">Northern / Far Southern</option>
                    </select>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-sm font-semibold text-gray-800 mb-4 bg-gray-100 p-2 rounded">Have you recently experienced any of the following?</h3>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="hidden" name="has_bone_pain" value="0">
                        <input type="checkbox" name="has_bone_pain" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Unexplained bone or joint pain</span>
                    </label>
                    <label class="flex items-center">
                        <input type="hidden" name="has_fatigue" value="0">
                        <input type="checkbox" name="has_fatigue" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Persistent fatigue or tiredness</span>
                    </label>
                    <label class="flex items-center">
                        <input type="hidden" name="has_muscle_weakness" value="0">
                        <input type="checkbox" name="has_muscle_weakness" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-700">Muscle weakness or cramps</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t">
                <button type="submit" class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-indigo-600 py-2.5 px-6 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all">
                    Analyze AI Risk Level
                </button>
            </div>
        </form>
    </div>
</body>
</html>