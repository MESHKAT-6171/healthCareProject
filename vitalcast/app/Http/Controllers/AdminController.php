<?php

namespace App\Http\Controllers;

use App\Models\HealthLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // View the Admin Dashboard
    public function index()
    {
        $allLogs = HealthLog::all(); // Grabs EVERY user's data
        return view('admin.index', compact('allLogs'));
    }

    // Generate and Download the CSV File
    public function exportCsv()
    {
        $logs = HealthLog::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=vitalcast_ml_dataset.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($logs) {
            $file = fopen('php://output', 'w');
            // 1. Create the CSV Header Row
            fputcsv($file, ['ID', 'User Name', 'Sleep (h)', 'Diet', 'Sunlight (h)', 'Water (L)', 'Stress (1-10)', 'Date Logged']);

            // 2. Loop through all database rows and write them to the file
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id, 
                    $log->user_name, 
                    $log->sleep_hours, 
                    $log->diet_quality, 
                    $log->sunlight_hours, 
                    $log->water_liters, 
                    $log->stress_level, 
                    $log->created_at->format('Y-m-d')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}