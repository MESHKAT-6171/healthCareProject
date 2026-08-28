<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // প্রোফাইল পেজ দেখানোর জন্য
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    // প্রোফাইল এবং পাসওয়ার্ড আপডেট করার জন্য
    public function update(Request $request)
    {
        $user = Auth::user();

        // সাধারণ ডেটা ভ্যালিডেশন
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:15|max:100',
            'major' => 'nullable|string|max:255',
        ]);

        // বেসিক ডেটা আপডেট করা
        $user->name = $request->name;
        $user->age = $request->age;
        $user->major = $request->major;

        // যদি ইউজার পাসওয়ার্ড পরিবর্তন করতে চায়
        if ($request->filled('current_password') || $request->filled('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed', // এটি স্বয়ংক্রিয়ভাবে new_password_confirmation এর সাথে মেলাবে
            ]);

            // বর্তমান পাসওয়ার্ড সঠিক কি না তা চেক করা
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'আপনার বর্তমান পাসওয়ার্ডটি সঠিক নয়।']);
            }

            // নতুন পাসওয়ার্ড এনক্রিপ্ট করে সেভ করা
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'প্রোফাইল সফলভাবে আপডেট করা হয়েছে!');
    }
}