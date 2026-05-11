<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Profile;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    // Admin Dashboard: Publications aur Profile dono ka data dikhane ke liye
    public function index() {
        $publications = Publication::orderBy('created_at', 'desc')->get();
        $profile = Profile::first(); // Pehla record uthayen
        return view('admin.index', compact('publications', 'profile'));
    }

    // Single Article Page: Reading platform ke liye
    public function show($id) {
        $article = Publication::findOrFail($id);
        return view('article', compact('article'));
    }

    // Naya Article (Scholarly/Creative) save karne ke liye
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
        ]);

        Publication::create($request->all());

        return redirect()->back()->with('success', 'Published successfully!');
    }

    // Publication Delete karne ke liye
    public function destroy($id) {
        $publication = Publication::findOrFail($id);
        
        if ($publication->file_path) {
            $filePath = public_path('uploads/' . $publication->file_path);
            if (file_exists($filePath)) { unlink($filePath); }
        }

        $publication->delete();
        return redirect()->back()->with('success', 'Publication deleted!');
    }

    // ************* PROFILE & SOCIAL LINKS UPDATE *************
    public function updateProfile(Request $request) {
        // 1. Check karen ke profile pehle se hai ya naya banana hai
        $profile = Profile::first() ?? new Profile();
        
        $data = $request->all();

        // 2. Profile Image Handle karen
        if ($request->hasFile('profile_image')) {
            // Purani image delete karen agar maujood hai
            if ($profile->profile_image && file_exists(public_path('images/profile/' . $profile->profile_image))) {
                unlink(public_path('images/profile/' . $profile->profile_image));
            }

            // Nayi image save karen
            $imageName = time().'_dr_yaseen.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images/profile'), $imageName);
            $data['profile_image'] = $imageName;
        }

        // 3. Saara data (YouTube, LinkedIn, etc.) save karen
        $profile->fill($data);
        $profile->save();

        return redirect()->back()->with('success', 'Academic Identity & Social Links Updated Successfully!');
    }

    // ************* CONTACT FORM SUBMISSION (NEW) *************
    public function sendContact(Request $request) {
        // Form data validate karen
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Abhi ke liye hum sirf success message bhej rahe hain.
        // Jab website live hogi, tab yahan asli Email sending ka code ayega.
        return redirect()->back()->with('success', 'Your message has been sent. Dr. Ghulam Yaseen will contact you shortly.');
    }
}