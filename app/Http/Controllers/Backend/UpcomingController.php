<?php

namespace App\Http\Controllers\Backend;


use App\Models\Upcoming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class UpcomingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $upcoming = Upcoming::paginate(15);
        return view('backend.upcoming.index', compact('upcoming'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.upcoming.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'venue' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);
        $upcoming = new Upcoming;
        $upcoming->title = $request->title;
        $upcoming->from_date = $request->from_date;
        $upcoming->to_date = $request->to_date;
        $upcoming->venue = $request->venue;

        if ($request->hasFile('file')) {
            $fileName = time() . '-upcoming-' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads/upcomings', $fileName, 'public');
            $upcoming->pdf_file = '/public/storage/' . $filePath;
        }
        $upcoming->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Upcoming Training Programme added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('backend.upcoming.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $upcoming = Upcoming::findOrFail(decrypt($id));
        return view('backend.upcoming.edit', compact('upcoming'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'venue' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        $upcoming = Upcoming::findOrFail(decrypt($id));
        $upcoming->title = $request->title;
        $upcoming->from_date = $request->from_date;
        $upcoming->to_date = $request->to_date;
        $upcoming->venue = $request->venue;

        if ($request->hasFile('file')) {
            $fileName = time() . '-upcoming-' . $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads/upcomings', $fileName, 'public');
            $upcoming->pdf_file = '/public/storage/' . $filePath;
        }
        $upcoming->update();
        Artisan::call('cache:clear');
        return back()->with('success', 'Upcoming Training Programme  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Upcoming::findOrFail(decrypt($id))->delete();
        Artisan::call('cache:clear');
        return back()->with('success', 'Upcoming Training Programme  deleted successfully.');
    }
}
