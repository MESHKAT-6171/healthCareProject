<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - Login</title>
    <style>body{font-family:sans-serif; padding:40px; background:#f4f4f9;} .box{background:white; padding:30px; border-radius:8px; max-width:400px; margin:auto;} input{width:100%; padding:10px; margin-bottom:10px; box-sizing:border-box;} button{background:green; color:white; padding:10px; width:100%; border:none; cursor:pointer;} .error{color:red; font-size:12px;} .success{color:green; margin-bottom:15px;}</style>
</head>
<body>
    <div class="box">
        <h2>VitalCast Login</h2>
        
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Password</label>
            <input type="password" name="password">
            
            <button type="submit">Login</button>
        </form>
        <p style="text-align:center; font-size:14px;">Need an account? <a href="/register">Register here</a></p>
    </div>
</body>
</html>