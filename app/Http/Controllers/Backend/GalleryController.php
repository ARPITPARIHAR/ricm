<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GalleryController extends Controller
{
    public function index()
    {
        $details = Gallery::paginate(15);
        return view('backend.galleries.index', compact('details'));
    }

    public function create()
    {
        return view('backend.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate multiple images
        ]);

        $detail = new Gallery;
        $detail->title = $request->title;

        // Handle multiple images
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Generate a unique file name
                $fileName = time() . '-' . $image->getClientOriginalName();
                // Store the image
                $filePath = $image->storeAs('uploads/images', $fileName, 'public');
                // Save the image path
                $imagePaths[] = '/public/storage/' . $filePath;
            }
            // Store the image paths in the database (as JSON)
            $detail->image_paths = json_encode($imagePaths);
        }

        $detail->save();
        Artisan::call('cache:clear');
        return back()->with('success', 'Details added successfully.');
    }

    public function show($id)
    {
        return view('backend.galleries.show');
    }

    public function edit($id)
    {
        $detail = Gallery::findOrFail(decrypt($id));
        return view('backend.galleries.edit', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate multiple images
        ]);

        $detail = Gallery::findOrFail(decrypt($id));
        $imagePaths = array();
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Generate a unique file name
                $fileName = time() . '-' . $image->getClientOriginalName();
                // Store the image
                $filePath = $image->storeAs('uploads/images', $fileName, 'public');
                // Save the image path
                $imagePaths[] = '/public/storage/' . $filePath;
            }
            // Store the image paths in the database (as JSON)

        }
        if ($request->old_images) {
            foreach ($request->old_images as $key => $image) {
                $imagePaths[] = $image;
            }
        }
        $detail->image_paths = json_encode($imagePaths);
        $detail->title = $request->title;
        $detail->save();

        Artisan::call('cache:clear');

        return back()->with('success', 'Detail updated successfully.');
    }

    public function destroy($id)
    {
        Gallery::findOrFail(decrypt($id))->delete();
        Artisan::call('cache:clear');
        return back()->with('success', 'Detail deleted successfully.');
    }
}
