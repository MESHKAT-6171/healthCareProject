<!DOCTYPE html>
<html>
<head>
    <title>VitalCast - Register</title>
    <style>body{font-family:sans-serif; padding:40px; background:#f4f4f9;} .box{background:white; padding:30px; border-radius:8px; max-width:400px; margin:auto;} input{width:100%; padding:10px; margin-bottom:10px; box-sizing:border-box;} button{background:blue; color:white; padding:10px; width:100%; border:none; cursor:pointer;} .error{color:red; font-size:12px;}</style>
</head>
<body>
    <div class="box">
        <h2>Campus Pilot Registration</h2>
        <form action="/register" method="POST">
            @csrf
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Password</label>
            <input type="password" name="password">
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Create Account</button>
        </form>
        <p style="text-align:center; font-size:14px;">Already have an account? <a href="/login">Log in here</a></p>
    </div>
</body>
</html>