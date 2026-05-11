@extends('layout')

@section('content')
<div class="mb-12 border-b-4 border-[#1A237E] pb-4">
    <h2 class="text-5xl font-bold text-[#1A237E]">Digital Archive</h2>
    <p class="italic text-gray-600 mt-2">Memories from Conferences, Events, and Scholarly Activities.</p>
</div>

<div class="grid md:grid-cols-3 gap-8">
    @foreach($items as $item)
        <div class="bg-white shadow-xl group">
            <div class="overflow-hidden">
                <img src="/images/archive/{{ $item->image_path }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
            </div>
            <div class="p-6">
                <span class="text-[10px] uppercase font-bold text-[#4E0707] tracking-widest">{{ $item->type }}</span>
                <h4 class="text-xl font-bold mt-2 mb-3">{{ $item->title }}</h4>
                <p class="text-gray-600 text-sm mb-6">{{ $item->description }}</p>
                
                <!-- Social Sharing -->
                <div class="flex space-x-4 border-t pt-4">
                    <span class="text-[9px] uppercase font-bold text-gray-400 self-center">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="text-gray-400 hover:text-blue-600 text-xs font-bold">FB</a>
                    <a href="https://twitter.com/intent/tweet?text={{ $item->title }}" target="_blank" class="text-gray-400 hover:text-blue-400 text-xs font-bold">TW</a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" target="_blank" class="text-gray-400 hover:text-blue-700 text-xs font-bold">IN</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection