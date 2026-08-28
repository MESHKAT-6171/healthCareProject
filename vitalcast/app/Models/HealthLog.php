<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HealthLog extends Model
{
    protected $fillable = [
    'user_name', 
    'sleep_hours', 
    'diet_quality', 
    'sunlight_hours', 
    'water_liters', 
    'stress_level'
];
}