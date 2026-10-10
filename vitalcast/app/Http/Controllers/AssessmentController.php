<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function showForm()
    {
        return view('assessment');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'age'                 => 'required|integer|min:1|max:120',
            'bmi'                 => 'required|numeric|min:10|max:60',
            'diet_type'           => 'required|string|in:Omnivore,Vegetarian,Vegan,Pescatarian',
            'sun_exposure'        => 'required|string|in:Low,Moderate,High',
            'latitude_region'     => 'required|string|in:Low,Mid,High',
            'has_bone_pain'       => 'required|integer|in:0,1',
            'has_fatigue'         => 'required|integer|in:0,1',
            'has_muscle_weakness' => 'required|integer|in:0,1',
        ]);

        try {
            // Send payload to FastAPI on port 8001
            $response = Http::timeout(5)->post('http://127.0.0.1:8001/api/predict-risk', $validated);

            if ($response->successful()) {
                $result = $response->json();


                // Save the prediction and user inputs to the SQLite database
            Assessment::create([
                'user_id'             => auth()->id(),
                'age'                 => $validated['age'],
                'bmi'                 => $validated['bmi'],
                'diet_type'           => $validated['diet_type'],
                'sun_exposure'        => $validated['sun_exposure'],
                'latitude_region'     => $validated['latitude_region'],
                'has_bone_pain'       => $validated['has_bone_pain'],
                'has_fatigue'         => $validated['has_fatigue'],
                'has_muscle_weakness' => $validated['has_muscle_weakness'],
                'risk_level'          => $result['risk_prediction'],
            ]);

                return view('assessment-result', [
                    'status'     => $result['risk_prediction'],
                    'risk_score' => $result['risk_score_percentage']
                ]);
            }

            Log::error('FastAPI Error Response', ['body' => $response->body()]);
            return back()->withErrors(['ai_error' => 'The AI microservice encountered a validation error.']);

        } catch (\Exception $e) {
            Log::error('FastAPI Connection Failure: ' . $e->getMessage());
            return back()->withErrors(['ai_error' => 'Could not connect to the AI service. Ensure FastAPI is running on port 8001.']);
        }
    }

    public function history()
{
    $assessments = Assessment::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('assessments.history', compact('assessments'));
}
}