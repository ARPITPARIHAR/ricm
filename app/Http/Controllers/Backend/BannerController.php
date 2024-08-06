<?php

namespace App\Http\Controllers\Backend;


use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::paginate(15);

        return view('backend.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'brief_description' => 'nullable|string',
            'hyperlink' => 'nullable|url', // Validate the hyperlink
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $banners = new Banner;
        $banners->title = $request->title;
        $banners->brief_description = $request->brief_description;
        $banners->hyperlink = $request->input('hyperlink'); // Save the hyperlink
        if ($request->hasFile('logo')) {
            $fileName = time() . '-logo-' . $request->file('logo')->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads/banners', $fileName, 'public');
            $banners->thumbnail_img = '/public/storage/' . $filePath;
        }
        $banners->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Banner  added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Banner::findOrFail(decrypt($id));
        return view('backend.information.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail(decrypt($id));
        return view('backend.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'brief_description' => 'nullable|string',
            'hyperlink' => 'nullable|url', // Validate the hyperlink
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $banners = Banner::findOrFail(decrypt($id));
        $banners->title = $request->title;
        $banners->brief_description = $request->brief_description;
        $banners->hyperlink = $request->input('hyperlink'); // Save the hyperlink
        if ($request->hasFile('logo')) {
            $fileName = time() . '-logo-' . $request->file('logo')->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads/banners', $fileName, 'public');
            $banners->thumbnail_img = '/public/storage/' . $filePath;
        }
        $banners->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Banner update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Banner::findOrFail(decrypt($id))->delete();
        Artisan::call('cache:clear');
        return back()->with('success', 'Banner deleted successfully.');
    }
}
