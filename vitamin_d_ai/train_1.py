import os
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder, StandardScaler
from sklearn.linear_model import LogisticRegression
from sklearn.tree import DecisionTreeClassifier
from sklearn.ensemble import (
    RandomForestClassifier,
    GradientBoostingClassifier,
    AdaBoostClassifier,
)
from sklearn.svm import SVC
from sklearn.metrics import accuracy_score, classification_report
import joblib

# 1. Ensure output directories exist
os.makedirs("artifacts", exist_ok=True)

# 2. Load Dataset
data_path = r"C:\webEngProject\vitamin_d_ai\data\vitamin_deficiency_disease_dataset_20260123.csv"
if not os.path.exists(data_path):
    raise FileNotFoundError(f"Dataset not found at {data_path}. Please verify the file path.")

df = pd.read_csv(data_path)
print(f"[+] Loaded dataset successfully with {len(df)} records.")

# 3. Target Definition
# Serum vitamin D < 20 ng/mL indicates deficiency risk
df["is_deficient"] = (df["serum_vitamin_d_ng_ml"] < 20.0).astype(int)

# 4. Feature Encoding
le_diet = LabelEncoder()
df["diet_encoded"] = le_diet.fit_transform(df["diet_type"])

le_sun = LabelEncoder()
df["sun_encoded"] = le_sun.fit_transform(df["sun_exposure"])

le_lat = LabelEncoder()
df["latitude_encoded"] = le_lat.fit_transform(df["latitude_region"])

# Save Encoders to artifacts/
joblib.dump(le_diet, "artifacts/diet_encoder.pkl")
joblib.dump(le_sun, "artifacts/sun_encoder.pkl")
joblib.dump(le_lat, "artifacts/lat_encoder.pkl")
print("[+] Encoders saved to artifacts/ folder.")

# 5. Define Features and Target
features = [
    "diet_encoded",
    "sun_encoded",
    "vitamin_d_percent_rda",
    "calcium_percent_rda",
    "age",
    "bmi",
    "latitude_encoded",
    "has_bone_pain",
    "has_fatigue",
    "has_muscle_weakness",
]

X = df[features]
y = df["is_deficient"]

# 6. Train/Test Split (80% Train, 20% Test)
X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42, stratify=y
)

# Scale features for models sensitive to feature magnitude
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
X_test_scaled = scaler.transform(X_test)
joblib.dump(scaler, "artifacts/scaler.pkl")

# 7. Model Benchmarking Pool
models = {
    "Logistic Regression": (
        LogisticRegression(max_iter=1000, random_state=42),
        True,
    ),
    "Decision Tree": (
        DecisionTreeClassifier(max_depth=6, random_state=42),
        False,
    ),
    "Random Forest": (
        RandomForestClassifier(n_estimators=200, max_depth=8, random_state=42),
        False,
    ),
    "AdaBoost": (
        AdaBoostClassifier(n_estimators=100, random_state=42),
        False,
    ),
    "Gradient Boosting": (
        GradientBoostingClassifier(n_estimators=200, max_depth=4, random_state=42),
        False,
    ),
    "Support Vector Machine": (
        SVC(probability=True, random_state=42),
        True,
    ),
}

best_model = None
best_acc = 0.0
best_model_name = ""

print("\n" + "=" * 45)
print(f"{'Algorithm':<25} | {'Test Accuracy':<15}")
print("=" * 45)

for name, (clf, needs_scaling) in models.items():
    X_tr = X_train_scaled if needs_scaling else X_train
    X_te = X_test_scaled if needs_scaling else X_test

    clf.fit(X_tr, y_train)
    predictions = clf.predict(X_te)
    acc = accuracy_score(y_test, predictions)

    print(f"{name:<25} | {acc * 100:.2f}%")

    if acc > best_acc:
        best_acc = acc
        best_model = clf
        best_model_name = name

print("=" * 45)
print(f"\n[+] Champion Model: {best_model_name} ({best_acc * 100:.2f}% Accuracy)")

# 8. Detailed Report for Champion Model
X_eval = X_test_scaled if models[best_model_name][1] else X_test
y_eval_pred = best_model.predict(X_eval)

print("\n--- Champion Classification Report ---")
print(classification_report(y_test, y_eval_pred, target_names=["Sufficient", "Deficient Risk"]))

# 9. Save Champion Model
champion_path = "artifacts/champion_vit_d_model.pkl"
joblib.dump(best_model, champion_path)
print(f"[+] Saved champion model to '{champion_path}'")