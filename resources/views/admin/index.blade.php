@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    
    <!-- Dashboard Header -->
    <div class="flex justify-between items-center mb-10 border-b-2 border-[#1A237E] pb-4">
        <h2 class="text-3xl font-bold text-[#1A237E] uppercase tracking-tighter">Control Center</h2>
        <span class="text-xs font-bold text-[#4E0707] uppercase tracking-[0.2em]">Dr. Ghulam Yaseen Dashboard</span>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-8 text-green-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tab Navigation Buttons -->
    <div class="flex space-x-2 mb-8 bg-gray-200 p-1 rounded-sm shadow-inner">
        <button onclick="openTab(event, 'tab-publications')" id="defaultOpen" class="tablinks flex-1 py-3 px-6 text-[10px] md:text-xs uppercase font-bold tracking-widest transition duration-300">
            Manage Publications
        </button>
        <button onclick="openTab(event, 'tab-gallery')" class="tablinks flex-1 py-3 px-6 text-[10px] md:text-xs uppercase font-bold tracking-widest transition duration-300">
            Manage Gallery (Archive)
        </button>
        <button onclick="openTab(event, 'tab-profile')" class="tablinks flex-1 py-3 px-6 text-[10px] md:text-xs uppercase font-bold tracking-widest transition duration-300">
            Academic Profile
        </button>
    </div>

    <!-- TAB 1: PUBLICATIONS -->
    <div id="tab-publications" class="tabcontent space-y-12">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-white p-6 shadow-xl border-t-4 border-[#1A237E]">
                <h3 class="text-sm font-bold mb-6 uppercase tracking-widest text-[#4E0707]">New Article</h3>
                <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Publication Title" class="w-full p-3 border border-gray-200 text-sm" required>
                    <select name="category" class="w-full p-3 border border-gray-200 text-sm bg-white">
                        <option value="scholarly">Scholarly Publication</option>
                        <option value="creative">Creative Yaseen</option>
                    </select>
                    <textarea name="description" placeholder="Short Summary" class="w-full p-3 border border-gray-200 text-sm h-24"></textarea>
                    <input id="pub_content" type="hidden" name="content">
                    <trix-editor input="pub_content" class="min-h-[200px] border border-gray-200 bg-white"></trix-editor>
                    <button type="submit" class="w-full bg-[#1A237E] text-white py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#4E0707] transition shadow-lg">Publish Content</button>
                </form>
            </div>
            <div class="lg:col-span-2 bg-white p-6 shadow-xl border-t-4 border-gray-200">
                <h3 class="text-sm font-bold mb-6 uppercase tracking-widest text-gray-400">Current Archive</h3>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 uppercase text-[10px] tracking-widest">
                        <tr><th class="p-4 border-b">Title</th><th class="p-4 border-b">Type</th><th class="p-4 border-b text-center">Action</th></tr>
                    </thead>
                    <tbody>
                        @foreach($publications as $pub)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 text-sm font-bold">{{ Str::limit($pub->title, 50) }}</td>
                            <td class="p-4 text-[10px] uppercase font-bold tracking-tighter italic">{{ $pub->category }}</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.publication.destroy', $pub->id) }}" method="POST">@csrf @method('DELETE')
                                    <button class="text-red-600 text-[10px] font-bold uppercase">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 2: GALLERY -->
    <div id="tab-gallery" class="tabcontent space-y-12 hidden">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-[#F5F5DC] p-6 shadow-xl border-t-4 border-[#4E0707]">
                <h3 class="text-sm font-bold mb-6 uppercase tracking-widest text-[#4E0707]">Add Media</h3>
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Event Name" class="w-full p-3 border border-gray-300 text-sm" required>
                    <input type="file" name="image" class="w-full p-2 border border-gray-300 text-xs bg-white" required>
                    <textarea name="description" placeholder="Description..." class="w-full p-3 border border-gray-300 text-sm h-32"></textarea>
                    <button type="submit" class="w-full bg-[#4E0707] text-white py-4 text-xs font-bold uppercase tracking-widest shadow-lg">Upload Media</button>
                </form>
            </div>
            <div class="lg:col-span-2 bg-white p-6 shadow-xl border-t-4 border-gray-200">
                <h3 class="text-sm font-bold mb-6 uppercase tracking-widest text-gray-400">Media Library</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach(\App\Models\Gallery::all() as $item)
                    <div class="border p-2 bg-gray-50">
                        <img src="/images/archive/{{ $item->image_path }}" class="w-full h-24 object-cover grayscale hover:grayscale-0">
                        <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="mt-2">@csrf @method('DELETE')
                            <button class="w-full bg-red-800 text-white text-[8px] py-1 font-bold uppercase">Remove</button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 3: ACADEMIC PROFILE -->
    <div id="tab-profile" class="tabcontent space-y-12 hidden">
        <div class="max-w-3xl mx-auto bg-white p-8 shadow-2xl border-t-4 border-[#1A237E]">
            <h3 class="text-lg font-bold mb-8 uppercase tracking-widest text-[#4E0707] border-b pb-2">Academic & Social Presence</h3>
            
            <!-- Added enctype for image upload -->
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Profile Image Upload Section -->
                <div class="p-4 bg-gray-50 border border-dashed border-gray-300 mb-6">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-[#1A237E] block mb-2">Profile Portrait (Official Image)</label>
                    <input type="file" name="profile_image" class="w-full p-2 text-xs bg-white border border-gray-200">
                    @if($profile && $profile->profile_image)
                        <p class="text-[9px] mt-2 text-green-600 uppercase font-bold italic font-serif">✓ Portrait is currently active</p>
                    @endif
                </div>

                <div>
                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Primary Research Interests (Comma Separated)</label>
                    <textarea name="research_interests" class="w-full p-4 border border-gray-200 text-sm h-24 bg-gray-50" placeholder="e.g. Literary History, Global Anglophone Novel, Postcolonial Theory...">{{ $profile->research_interests ?? '' }}</textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Google Scholar URL</label>
                        <input type="text" name="google_scholar" value="{{ $profile->google_scholar ?? '' }}" class="w-full p-3 border border-gray-200 text-sm bg-gray-50">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">LinkedIn Profile URL</label>
                        <input type="text" name="linkedin" value="{{ $profile->linkedin ?? '' }}" class="w-full p-3 border border-gray-200 text-sm bg-gray-50">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">YouTube Channel URL</label>
                        <input type="text" name="youtube" value="{{ $profile->youtube ?? '' }}" class="w-full p-3 border border-gray-200 text-sm bg-gray-50" placeholder="https://youtube.com/@...">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Substack Newsletter URL</label>
                        <input type="text" name="substack" value="{{ $profile->substack ?? '' }}" class="w-full p-3 border border-gray-200 text-sm bg-gray-50">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">ORCID iD</label>
                        <input type="text" name="orcid" value="{{ $profile->orcid ?? '' }}" class="w-full p-3 border border-gray-200 text-sm bg-gray-50">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">ResearchGate URL</label>
                        <input type="text" name="researchgate" value="{{ $profile->researchgate ?? '' }}" class="w-full p-3 border border-gray-200 text-sm bg-gray-50">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#1A237E] text-white py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#4E0707] transition duration-500 shadow-xl mt-4">
                    Update Academic Identity
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts for Tabs & Editor -->
<style>
    .tablinks.active { background-color: #1A237E; color: white; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
    .tablinks:not(.active) { color: #1A237E; opacity: 0.6; }
</style>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.add("hidden");
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).classList.remove("hidden");
        evt.currentTarget.classList.add("active");
    }

    document.getElementById("defaultOpen").click();
</script>

<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endsection