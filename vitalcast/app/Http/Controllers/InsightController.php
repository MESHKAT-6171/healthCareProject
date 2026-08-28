<?php

namespace App\Http\Controllers;

use App\Models\HealthLog;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function index()
    {
        // 1. Gather Diet Data (Count how many 'Good', 'Average', 'Poor')
        $dietData = HealthLog::selectRaw('diet_quality, count(*) as total')
            ->groupBy('diet_quality')
            ->pluck('total', 'diet_quality');

        // 2. Gather Sleep Data (Count how many people slept X hours)
        $sleepData = HealthLog::selectRaw('sleep_hours, count(*) as total')
            ->groupBy('sleep_hours')
            ->orderBy('sleep_hours')
            ->pluck('total', 'sleep_hours');

        return view('insights.index', compact('dietData', 'sleepData'));
    }
}