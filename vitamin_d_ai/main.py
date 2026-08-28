import os
import joblib
import numpy as np
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, Field

app = FastAPI(title="VitalCast AI - Vitamin D Risk Microservice")

# Resolve path relative to this file to ensure artifacts are found reliably
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
# This tells Python to go up one folder level to find the artifacts
ARTIFACTS_DIR = os.path.join(os.path.dirname(BASE_DIR), "artifacts")

# 1. Load Artifacts
try:
    model = joblib.load(os.path.join(ARTIFACTS_DIR, "champion_vit_d_model.pkl"))
    diet_encoder = joblib.load(os.path.join(ARTIFACTS_DIR, "diet_encoder.pkl"))
    sun_encoder = joblib.load(os.path.join(ARTIFACTS_DIR, "sun_encoder.pkl"))
    lat_encoder = joblib.load(os.path.join(ARTIFACTS_DIR, "lat_encoder.pkl"))
except Exception as e:
    raise RuntimeError(f"Failed to load artifacts from {ARTIFACTS_DIR}: {e}")

# 2. Request Schema (Updated for Pydantic V2)
class AssessmentRequest(BaseModel):
    diet_type: str = Field(..., json_schema_extra={"example": "Vegan"})
    sun_exposure: str = Field(..., json_schema_extra={"example": "Low"})
    age: int = Field(..., json_schema_extra={"example": 22})
    bmi: float = Field(..., json_schema_extra={"example": 24.5})
    latitude_region: str = Field(..., json_schema_extra={"example": "Mid"})
    has_bone_pain: int = Field(..., json_schema_extra={"example": 0})
    has_fatigue: int = Field(..., json_schema_extra={"example": 1})
    has_muscle_weakness: int = Field(..., json_schema_extra={"example": 0})
    
# 3. Prediction Route
@app.post("/api/predict-risk")
def predict_risk(data: AssessmentRequest):
    try:
        diet_enc = diet_encoder.transform([data.diet_type])[0]
        sun_enc = sun_encoder.transform([data.sun_exposure])[0]
        lat_enc = lat_encoder.transform([data.latitude_region])[0]
    except ValueError as err:
        raise HTTPException(status_code=422, detail=f"Invalid categorical input: {err}")

    # Feature vector matching the exact order from train.py
    features = np.array([[
        diet_enc,
        sun_enc,
        data.age,
        data.bmi,
        lat_enc,
        data.has_bone_pain,
        data.has_fatigue,
        data.has_muscle_weakness
    ]])

    prediction = int(model.predict(features)[0])
    risk_score = float(model.predict_proba(features)[0][1])

    return {
        "status": "success",
        "risk_prediction": "Deficient Risk" if prediction == 1 else "Sufficient",
        "risk_score_percentage": round(risk_score * 100, 2)
    }