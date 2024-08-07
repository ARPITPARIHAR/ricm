<?php

namespace App\Http\Controllers\Backend;

use App\Models\Client;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Information::paginate(15);
        return view('backend.information.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.information.create');
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
        $client = new Information;

        $client->title = $request->title;
        $client->brief_description = $request->brief_description;
        $client->hyperlink = $request->input('hyperlink'); // Save the hyperlink
        if ($request->hasFile('logo')) {
            $fileName = time() . '-logo-' . $request->file('logo')->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads/clients', $fileName, 'public');
            $client->logo = '/public/storage/' . $filePath;
        }
        $client->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Client  added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Information::findOrFail(decrypt($id));
        return view('backend.information.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Information::findOrFail(decrypt($id));
        return view('backend.information.edit', compact('client'));
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
        $client = Information::findOrFail(decrypt($id));

        $client->title = $request->title;
        $client->brief_description = $request->brief_description;
        $client->hyperlink = $request->input('hyperlink'); // Save the hyperlink
        if ($request->hasFile('logo')) {
            $fileName = time() . '-logo-' . $request->file('logo')->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads/clients', $fileName, 'public');
            $client->logo = '/public/storage/' . $filePath;
        }
        $client->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Information  update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Information::findOrFail(decrypt($id))->delete();
        Artisan::call('cache:clear');
        return back()->with('success', 'Information deleted successfully.');
    }
}