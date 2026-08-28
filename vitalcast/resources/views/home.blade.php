<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - Dashboard</title>
    <style>
        /* Modern Color Palette & Setup */
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg: #F3F4F6;
            --card-bg: #FFFFFF;
            --text-main: #111827;
            --text-muted: #6B7280;
        }
        
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: var(--bg); 
            color: var(--text-main); 
            margin: 0; 
            padding: 0; 
        }
        
        .container { 
            max-width: 1100px; 
            margin: 0 auto; 
            padding: 40px 20px; 
        }

        /* 1. Glassmorphism-style Header */
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            background: var(--card-bg); 
            padding: 20px 30px; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); 
            margin-bottom: 30px; 
        }
        .header-left { display: flex; align-items: center; gap: 20px; }
        .header-left h2 { margin: 0; font-size: 22px; color: var(--primary); font-weight: 800; letter-spacing: -0.5px;}
        
        /* Header Buttons */
        .btn { padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; cursor: pointer; transition: all 0.2s ease; border: none; font-size: 14px; }
        .btn-profile { background: #FEF3C7; color: #D97706; }
        .btn-profile:hover { background: #FDE68A; transform: scale(1.05); }
        .btn-logout { background: #FEE2E2; color: #EF4444; }
        .btn-logout:hover { background: #FECACA; transform: scale(1.05); }

        /* 2. Welcome Banner Gradient */
        .welcome-banner { 
            background: linear-gradient(135deg, var(--primary), #8B5CF6); 
            color: white; 
            padding: 40px; 
            border-radius: 16px; 
            margin-bottom: 40px; 
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); 
        }
        .welcome-banner h3 { margin: 0 0 10px 0; font-size: 32px; font-weight: 700; }
        .welcome-banner p { margin: 0; opacity: 0.9; font-size: 16px; line-height: 1.5; }

        /* 3. Action Cards Grid Layout */
        .section-title { font-size: 20px; margin-bottom: 20px; color: var(--text-main); font-weight: 600; }
        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 24px; 
        }
        
        /* Interactive Cards */
        .action-card { 
            background: var(--card-bg); 
            padding: 30px; 
            border-radius: 16px; 
            text-decoration: none; 
            color: var(--text-main); 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); 
            border: 1px solid #E5E7EB; 
            display: flex; 
            flex-direction: column; 
            gap: 15px; 
        }
        .action-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); 
            border-color: var(--primary); 
        }
        
        /* Card Icons */
        .icon-box { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
        .bg-green { background: #D1FAE5; }
        .bg-blue { background: #DBEAFE; }
        .bg-purple { background: #EDE9FE; }
        
        .action-card h4 { margin: 0; font-size: 18px; font-weight: 700; }
        .action-card p { margin: 0; color: var(--text-muted); font-size: 14px; line-height: 1.5; }

        /* 4. AI Assessment Banner */
        .ai-banner-container { margin-top: 30px; }
        .ai-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #6366F1, #A855F7);
            padding: 25px 30px;
            border-radius: 16px;
            color: white;
            text-decoration: none;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 20px;
        }
        .ai-banner:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.4);
        }
        .ai-banner-content { display: flex; align-items: center; gap: 20px; }
        .ai-icon-box {
            width: 55px; height: 55px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }
        .ai-banner-text h4 { margin: 0 0 5px 0; font-size: 20px; font-weight: 700; }
        .ai-banner-text p { margin: 0; font-size: 15px; opacity: 0.9; line-height: 1.4; }
        .ai-btn {
            background: white;
            color: var(--primary);
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            flex-shrink: 0;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .ai-btn:hover { background: #F3F4F6; transform: scale(1.05); }

        /* Responsive Design for smaller screens */
        @media (max-width: 768px) {
            .ai-banner { flex-direction: column; text-align: center; }
            .ai-banner-content { flex-direction: column; }
            .ai-btn { width: 100%; box-sizing: border-box; text-align: center; }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <h2>VitalCast</h2>
                <a href="{{ route('profile.edit') }}" class="btn btn-profile">⚙️ Profile</a>
            </div>
            
            <form action="/logout" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <h3>Welcome back, {{ Auth::user()->name }}! 👋</h3>
            <p>Your session is active. Track your daily wellness, monitor campus trends, and contribute to our predictive health models today.</p>
        </div>

        <h3 class="section-title">What would you like to do?</h3>

        <!-- Main Action Grid -->
        <div class="grid">
            
            <a href="{{ route('logs.create') }}" class="action-card">
                <div class="icon-box bg-green">➕</div>
                <div>
                    <h4>Log Daily Health</h4>
                    <p>Enter your latest sleep, diet, water intake, and stress metrics into the database.</p>
                </div>
            </a>

            <a href="{{ route('logs.index') }}" class="action-card">
                <div class="icon-box bg-blue">📋</div>
                <div>
                    <h4>View My History</h4>
                    <p>Look back at your previous entries and track your personal consistency over time.</p>
                </div>
            </a>

            <a href="{{ route('insights') }}" class="action-card">
                <div class="icon-box bg-purple">📊</div>
                <div>
                    <h4>Campus Insights</h4>
                    <p>View real-time, anonymized data charts showing the health trends of the student body.</p>
                </div>
            </a>

        </div>

        <!-- NEW AI Assessment Banner -->
        <div class="ai-banner-container">
            <a href="{{ route('assessment.form') }}" class="ai-banner">
                <div class="ai-banner-content">
                    <div class="ai-icon-box">✨</div>
                    <div class="ai-banner-text">
                        <h4>AI Vitamin D Assessment</h4>
                        <p>Take our 8-question lifestyle test. Our FastAPI Machine Learning model will predict your deficiency risk in real-time.</p>
                    </div>
                </div>
                <div class="ai-btn">Try AI Prediction &rarr;</div>
            </a>
        </div>

    </div>

</body>
</html>