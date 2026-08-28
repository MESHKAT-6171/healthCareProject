# VitalCast: Predictive Health & AI Assessment Platform

VitalCast is a full-stack health monitoring and predictive analytics platform. It utilizes a modern microservices architecture, bridging a robust Laravel web application with a dedicated Python FastAPI machine learning server to deliver real-time health risk assessments.

## 🧠 Core Architecture

This project is separated into two specialized environments running concurrently:

1. **The Web Backend (PHP/Laravel):** Handles user authentication, session management, SQLite database routing, and rendering the responsive Tailwind CSS frontend views.
2. **The AI Microservice (Python/FastAPI):** A self-contained inference server that loads pre-trained scikit-learn models into memory and processes incoming HTTP prediction requests with strict Pydantic data validation.

## ✨ Key Features

* **Real-Time AI Inference:** Users complete an 8-question non-invasive lifestyle assessment. The Laravel backend transmits this payload to the FastAPI server, which processes the data through a Random Forest Classifier to predict Vitamin D deficiency risk.
* **Health Logging Dashboard:** Secure user portal to log daily sleep, diet, water intake, and stress metrics.
* **Campus Insights:** Aggregated, anonymized data visualization for monitoring broad health trends.
* **Automated Startup:** Includes a custom Windows Batch script (`start_servers.bat`) to instantiate both the virtual environment and dual servers simultaneously.

## 🛠️ Technology Stack

**Web Application (Port 8000)**
* Laravel 11
* PHP 8.2
* SQLite
* CSS / Blade Templating

**AI Microservice (Port 8001)**
* Python 3
* FastAPI & Uvicorn
* Scikit-Learn (Random Forest)
* Pandas & NumPy
* Joblib (Model Serialization)

## 🚀 Local Development Setup

### 1. Clone the Repository
```bash
git clone https://github.com/MESHKAT-6171/healthCareProject.git
cd healthCareProject
```

### 2. Configure the Web Server (Laravel)
```bash
cd vitalcast
copy .env.example .env
composer install
php artisan key:generate
php artisan migrate
```

### 3. Configure the AI Server (FastAPI)
```bash
cd ../vitamin_d_ai
python -m venv venv
.\venv\Scripts\activate
pip install -r requirements.txt
```

### 4. Boot the Microservices
You can launch the entire architecture with a single click using the included batch script:
1. Navigate to the root `healthCareProject` folder in Windows File Explorer.
2. Double-click `start_servers.bat`.
3. Access the platform at `[http://127.0.0.1:8000](http://127.0.0.1:8000)`.

## 📊 Machine Learning Model Details
The current champion model is a Random Forest Classifier trained on behavioral and environmental data (Diet, Sun Exposure, BMI, Latitude, and basic symptom checks). By completely excluding complex medical lab data from the feature set, the model achieves **81.6% accuracy**, making it highly accessible for general user assessments.

