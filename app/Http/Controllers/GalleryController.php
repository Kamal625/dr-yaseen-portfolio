<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    // Archive page par saara data dikhane ke liye
    public function index() {
        $items = Gallery::orderBy('created_at', 'desc')->get();
        return view('gallery', compact('items'));
    }

    // Naya Media (Image/Video) save karne ke liye
    public function store(Request $request) {
        // 1. Validation: Image size barha kar 10MB (10240) kar di hai
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|max:10240', 
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:51200', // 50MB tak ki video
        ]);

        $data = $request->all();

        // 2. Image Handling
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/archive'), $imageName);
            $data['image_path'] = $imageName;
        }

        // 3. Direct Video Upload Handling (Agar upload ki jaye)
        if ($request->hasFile('video')) {
            $videoName = time().'_video.'.$request->video->extension();
            $request->video->move(public_path('videos/archive'), $videoName);
            $data['video_path'] = $videoName;
        }

        // 4. Default Type fix (SQL 23000 error se bachne ke liye)
        $data['type'] = $request->type ?? 'event';

        // 5. Database mein save karna
        Gallery::create($data);

        return redirect()->back()->with('success', 'Media item added to archive successfully!');
    }

    // Item delete karne ke liye (Saath asli files bhi delete hongi)
    public function destroy($id) {
        $item = Gallery::findOrFail($id);

        // Asli Image delete karen
        $imagePath = public_path('images/archive/' . $item->image_path);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Agar Video hai to usay bhi delete karen
        if ($item->video_path) {
            $videoPath = public_path('videos/archive/' . $item->video_path);
            if (File::exists($videoPath)) {
                File::delete($videoPath);
            }
        }

        $item->delete();

        return redirect()->back()->with('success', 'Archive item removed successfully!');
    }
}