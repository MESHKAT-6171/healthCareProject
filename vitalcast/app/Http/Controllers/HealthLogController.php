<?php

namespace App\Http\Controllers;

use App\Models\HealthLog;
use Illuminate\Http\Request;

class HealthLogController extends Controller
{
    // READ: Show logs with optional filtering!
    public function index(Request $request)
    {
        // 1. Start the query (সবার ডেটা দেখাবে যেহেতু আমরা Privacy Lockdown করিনি)
        $query = HealthLog::query();

        // 2. Check if the user typed a specific Sleep Hour in the filter box
        if ($request->filled('sleep_hours')) {
            $query->where('sleep_hours', $request->sleep_hours);
        }

        // 3. Check if the user selected a specific Diet Quality from the dropdown
        if ($request->filled('diet_quality')) {
            $query->where('diet_quality', $request->diet_quality);
        }

        // 4. Execute the query to fetch the filtered data
        $logs = $query->get();

        // 5. Send the filtered data to the view
        return view('logs.index', compact('logs'));
    }

    // CREATE: Show the submission form
    public function create()
    {
        return view('logs.create');
    }

    // CREATE: Validate and save to the database
    public function store(Request $request)
    {
        // 1. Validation (User Name ফর্ম থেকে নিচ্ছে)
        $validatedData = $request->validate([
            'user_name' => 'required|min:3',
            'sleep_hours' => 'required|numeric|min:0|max:24',
            'diet_quality' => 'required',
            'sunlight_hours' => 'required|numeric|min:0|max:24',
            'water_liters' => 'required|numeric|min:0|max:10',
            'stress_level' => 'required|integer|min:1|max:10'
        ]);

        // 2. Database Insertion
        HealthLog::create($validatedData);

        return redirect()->route('logs.index')->with('success', 'Health log saved successfully!');
    }

    // DELETE: Remove a record from the database
    public function destroy(HealthLog $log)
    {
        $log->delete();
        return redirect()->route('logs.index')->with('success', 'Log deleted successfully!');
    }
}