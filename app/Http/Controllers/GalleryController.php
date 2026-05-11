<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index() {
        $items = Gallery::orderBy('created_at', 'desc')->get();
        return view('gallery', compact('items'));
    }

    public function store(Request $request) {
        $request->validate(['title' => 'required', 'image' => 'required|image']);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/archive'), $imageName);

        Gallery::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'image_path' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Archive item added!');
    }
    public function destroy($id) {
    $item = Gallery::findOrFail($id);

    // 1. Asli image file ko computer/server se delete karna
    $imagePath = public_path('images/archive/' . $item->image_path);
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // 2. Database se record delete karna
    $item->delete();

    return redirect()->back()->with('success', 'Archive item deleted successfully!');
}
}