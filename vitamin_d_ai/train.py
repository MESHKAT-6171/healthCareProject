import os
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score, classification_report
import joblib

os.makedirs("artifacts", exist_ok=True)

# 1. Load Dataset
data_path = r"C:\webEngProject\vitamin_d_ai\data\vitamin_deficiency_disease_dataset_20260123.csv"
df = pd.read_csv(data_path)

# Target: 1 for Deficient Risk, 0 for Sufficient
df["is_deficient"] = (df["serum_vitamin_d_ng_ml"] < 20.0).astype(int)

# 2. Encode Categoricals
le_diet = LabelEncoder()
df["diet_encoded"] = le_diet.fit_transform(df["diet_type"])

le_sun = LabelEncoder()
df["sun_encoded"] = le_sun.fit_transform(df["sun_exposure"])

le_lat = LabelEncoder()
df["latitude_encoded"] = le_lat.fit_transform(df["latitude_region"])

joblib.dump(le_diet, "artifacts/diet_encoder.pkl")
joblib.dump(le_sun, "artifacts/sun_encoder.pkl")
joblib.dump(le_lat, "artifacts/lat_encoder.pkl")

# 3. STRICTLY Non-Medical Features (8 Questions)
features = [
    "diet_encoded",
    "sun_encoded",
    "age",
    "bmi",
    "latitude_encoded",
    "has_bone_pain",
    "has_fatigue",
    "has_muscle_weakness",
]

X = df[features]
y = df["is_deficient"]

# 4. Train/Test Split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# 5. Train Random Forest Model
model = RandomForestClassifier(n_estimators=200, max_depth=8, random_state=42)
model.fit(X_train, y_train)

# 6. Evaluate and Save
predictions = model.predict(X_test)
print(f"\n[+] Champion Model Accuracy (No Medical Data): {accuracy_score(y_test, predictions) * 100:.2f}%\n")
print(classification_report(y_test, predictions, target_names=["Sufficient", "Deficient Risk"]))

joblib.dump(model, "artifacts/champion_vit_d_model.pkl")