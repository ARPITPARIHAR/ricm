<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('backend.dashboard');
    }

    public function businessSettings(Request  $request)
    {
        $business_info = BusinessSetting::find(1);
        return view('backend.Settings.business-info', compact('business_info'));
    }
    public function businessSettingsUpdate(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string',
            'email' => 'required|string|email',
            'contact_numbers' => 'required|string',
            'address' => 'required|string',
            'brief_description' => 'required|string',
            'instagram' => 'nullable|url',
            'linked_in' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|string',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'admin_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $business_info = BusinessSetting::find(1);
        $business_info->business_name = $request->business_name;
        $business_info->email = $request->email;
        $business_info->contact_numbers = $request->contact_numbers;
        $business_info->address = $request->address;
        $business_info->brief_description = $request->brief_description;
        $business_info->instagram = $request->instagram ?? '#';
        $business_info->linked_in = $request->linked_in ?? '#';
        $business_info->facebook = $request->facebook ?? '#';
        $business_info->twitter = $request->twitter ?? '#';
        $business_info->youtube = $request->youtube ?? '#';
        $business_info->whatsapp = $request->whatsapp ?? NULL;
        if ($request->hasFile('header_logo')) {
            $fileName = time() . '-header-logo-' . $request->file('header_logo')->getClientOriginalName();
            $filePath = $request->file('header_logo')->storeAs('uploads/logos', $fileName, 'public');
            $business_info->header_logo = '/public/storage/' . $filePath;
        }
        if ($request->hasFile('footer_logo')) {
            $fileName = time() . '-footer-logo-' . $request->file('footer_logo')->getClientOriginalName();
            $filePath = $request->file('footer_logo')->storeAs('uploads/logos', $fileName, 'public');
            $business_info->footer_logo = '/public/storage/' . $filePath;
        }
        if ($request->hasFile('admin_logo')) {
            $fileName = time() . '-admin-logo-' . $request->file('admin_logo')->getClientOriginalName();
            $filePath = $request->file('admin_logo')->storeAs('uploads/logos', $fileName, 'public');
            $business_info->admin_logo = '/public/storage/' . $filePath;
        }
        $business_info->update();
        if ($request->password) {
            # code...
        }
        Artisan::call('cache:clear');
        return back()->with('success', 'Business information updated Successfully.');
    }
    public function profile()
    {
        $profile = auth()->user();
        return view('backend.Settings.profile', compact('profile'));
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|confirmed|min:8',
        ]);
        $profile = User::findOrFail(auth()->user()->id);
        $profile->name = $request->name;
        $profile->email = $request->email;
        if ($request->hasFile('avatar')) {
            $fileName = time() . '-avatar-' . $request->file('avatar')->getClientOriginalName();
            $filePath = $request->file('avatar')->storeAs('uploads/profiles', $fileName, 'public');
            $profile->avatar = '/public/storage/' . $filePath;
        }
        if ($request->password) {
            $profile->password = Hash::make($request->password);
        }
        $profile->update();
        return back()->with('success', 'Profile updated Successfully.');
    }
}
