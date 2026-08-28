<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - Profile Settings</title>
    <style>
        body{font-family:sans-serif; padding:40px; background:#f4f4f9;} 
        .box{background:white; padding:30px; border-radius:8px; max-width:500px; margin:auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1);} 
        input{width:100%; padding:10px; margin-bottom:10px; box-sizing:border-box; border:1px solid #ccc; border-radius:4px;} 
        button{background:#ff9800; color:white; padding:12px; width:100%; border:none; cursor:pointer; font-weight:bold; border-radius:4px;} 
        .error{color:red; font-size:12px; margin-top:-10px; margin-bottom:10px; display:block;}
        .success{color:green; margin-bottom:15px; font-weight:bold;}
        .section-title {border-bottom: 1px solid #eee; padding-bottom: 5px; margin-top: 25px; margin-bottom: 15px;}
        .btn-back { display:inline-block; margin-bottom: 20px; background: gray; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="box">
        <a href="/home" class="btn-back">← Back to Dashboard</a>
        <h2>⚙️ Profile Settings</h2>
        
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <h3 class="section-title">Personal Information</h3>
            
            <label>Display Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <label>Age</label>
            <input type="number" name="age" value="{{ old('age', $user->age) }}">
            @error('age') <span class="error">{{ $message }}</span> @enderror

            <label>E-mail</label>
            <input type="text" name="major" value="{{ old('major', $user->major) }}" placeholder="e.g. Computer Science">
            @error('major') <span class="error">{{ $message }}</span> @enderror


            <h3 class="section-title">Security (Change Password)</h3>
            <p style="font-size: 12px; color: gray;">Leave blank if you do not want to change your password.</p>

            <label>Current Password</label>
            <input type="password" name="current_password">
            @error('current_password') <span class="error">{{ $message }}</span> @enderror

            <label>New Password</label>
            <input type="password" name="new_password">
            @error('new_password') <span class="error">{{ $message }}</span> @enderror

            <label>Confirm New Password</label>
            <input type="password" name="new_password_confirmation">

            <button type="submit" style="margin-top: 15px;">Update Profile</button>
        </form>
    </div>
</body>
</html>