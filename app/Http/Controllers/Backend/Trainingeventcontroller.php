<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trainingevent;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Artisan;

class TrainingeventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = Trainingevent::orderBy('category_id')->latest()->paginate(15);
        return view('backend.trainingevent.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Trainingevent::where('category_id', 0)->get();


        return view('backend.trainingevent.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|integer',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $detail = new Trainingevent;

        $detail->title = $request->title;
        if ($request->category_id) {
            $detail->category_id = $request->category_id;
        } else {
            $detail->category_id = 0;
        }
        if ($request->hasFile('pdf_file')) {
            $fileName = time() . '-trainingevent-' . $request->file('pdf_file')->getClientOriginalName();
            $filePath = $request->file('pdf_file')->storeAs('uploads/trainingevents', $fileName, 'public');
            $detail->pdf_file = '/public/storage/' . $filePath;
        }
        $detail->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $trainingEvents = Trainingevent::where('category_id', $id)->get();

        dd($trainingEvents);
        return view('frontend.show', compact('trainingEvents'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit($id)
    {
        $detail = Trainingevent::findOrFail(decrypt($id));
        $categories = Trainingevent::where('category_id', 0)->get();
        return view('backend.trainingevent.edit', compact('detail', 'categories'));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'category_id' => 'nullable|integer',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',

        ]);
        $detail = Trainingevent::findOrFail(decrypt($id));
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
        $detail->title = $request->title;
        $detail->update();
        Artisan::call('cache:clear');
        return back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Trainingevent::findOrFail(decrypt($id))->delete();
        Artisan::call('cache:clear');
        return back()->with('success', 'Detail deleted successfully.');
    }
}
