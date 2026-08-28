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
* Tailwind CSS / Blade Templating

**AI Microservice (Port 8001)**
* Python 3
* FastAPI & Uvicorn
* Scikit-Learn (Random Forest)
* Pandas & NumPy
* Joblib (Model Serialization)

## 🚀 Local Development Setup

### 1. Clone the Repository
```bash
git clone [https://github.com/MESHKAT-6171/healthCareProject.git](https://github.com/MESHKAT-6171/healthCareProject.git)
cd healthCareProject