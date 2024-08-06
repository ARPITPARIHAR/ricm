<?php

namespace App\Http\Controllers\Backend;

use App\Models\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = Study::orderBy('category_id')->latest()->paginate(15);
        return view('backend.study.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Study::where('category_id', 0)->get();
        return view('backend.study.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'nullable|integer',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048'

        ]);
        $detail = new Study;
        $detail->title = $request->title;
        if ($request->category_id) {
            $detail->category_id = $request->category_id;
        } else {
            $detail->category_id = 0;
        }
        if ($request->hasFile('pdf_file')) {
            $fileName = time() . '-trainingevent-' . $request->file('pdf_file')->getClientOriginalName();
            $filePath = $request->file('pdf_file')->storeAs('uploads/studymaterials', $fileName, 'public');
            $detail->pdf_file = '/public/storage/' . $filePath;
        }

        $detail->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Study Material added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('backend.study.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detail = Study::findOrFail(decrypt($id));
        $categories = Study::where('category_id', 0)->get();
        return view('backend.study.edit', compact('detail', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'nullable|integer',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',

        ]);
        $detail = Study::findOrFail(decrypt($id));
        $detail->title = $request->title;
        if ($request->category_id) {
            $detail->category_id = $request->category_id;
        } else {
            $detail->category_id = 0;
            $detail->pdf_file = null;
        }
        if ($request->hasFile('pdf_file')) {
            $fileName = time() . '-trainingevent-' . $request->file('pdf_file')->getClientOriginalName();
            $filePath = $request->file('pdf_file')->storeAs('uploads/trainingevents', $fileName, 'public');
            $detail->pdf_file = '/public/storage/' . $filePath;
        }
        $detail->update();
        Artisan::call('cache:clear');
        return back()->with('success', 'Study Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Study::findOrFail(decrypt($id))->delete();
        Artisan::call('cache:clear');
        return back()->with('success', 'Detail deleted successfully.');
    }
}
