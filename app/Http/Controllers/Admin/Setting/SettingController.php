<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.setting.index', compact('user'));
    }
    
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'phone'   => ['nullable','string','max:30'],
            'gender'  => ['nullable','in:Male,Female,Other'],
            'dob'     => ['nullable','date'],
            'address' => ['nullable','string','max:500'],
            'city'    => ['nullable','string','max:120'],
            'state'   => ['nullable','string','max:120'],
            'country' => ['nullable','string','max:120'],
            'zipcode'     => ['nullable','string','max:20'],
        ]);

        $user->fill($data)->save();

        return back()->with('success','Profile updated.');
    }
    public function updateAvatar(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'avatar' => ['required','image','mimes:jpeg,jpg,png','max:4096'],
        ]);

        // store in storage/app/public/avatars
        $path = $request->file('avatar')->store('avatars', 'public');

        // delete old if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = $path;
        $user->save();

        return back()->with('success','Avatar updated.');
    }

    public function changePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $request->validate([
            'current_password'      => ['required'],
            'new_password'          => ['required', 'string', 'min:6', Password::min(6)],
            'new_password_confirm'  => ['required', 'same:new_password'],
        ]);

        if (! Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        // Update password
        $user->password = Hash::make($data['new_password']);
        $user->save();

        // (Optional) logout other sessions: $request->session()->regenerate();

        return back()->with('success', 'Password changed successfully.');
    }
}

