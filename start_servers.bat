@echo off
echo ===================================================
echo   Booting up VitalCast Full Stack Architecture...
echo ===================================================

:: Start the Python AI Microservice in a new window
echo Starting FastAPI AI Server...
start "VitalCast AI" cmd /k "cd C:\healthCareProject\vitamin_d_ai && .\venv\Scripts\activate.bat && uvicorn main:app --reload --port 8001"

:: Start the Laravel Web Server in a new window
echo Starting Laravel Web Server...
start "VitalCast Web" cmd /k "cd C:\healthCareProject\vitalcast && php artisan serve"

echo Both servers are launching in the background!
exit