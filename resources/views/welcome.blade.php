@extends('layout')

@section('content')
<!-- Hero Section (Scholar Identity) -->
<div class="text-center mb-16 py-10 border-b border-[#1A237E]/10">
    <h2 class="text-6xl font-bold mb-4 text-[#1A237E]">Dr. Ghulam Yaseen</h2>
    
    <!-- Prestigious Title -->
    <div class="flex items-center justify-center space-x-4 mb-6 text-[#4E0707]">
        <div class="h-[1px] w-12 bg-[#4E0707]/30"></div>
        <p class="text-xl italic font-serif tracking-wide uppercase text-[14px] md:text-xl">
            Scholar of Global Anglophone Novel
        </p>
        <div class="h-[1px] w-12 bg-[#4E0707]/30"></div>
    </div>

    <p class="text-lg text-gray-700 max-w-2xl mx-auto leading-relaxed italic">
        "Exploring the evolution of the novel across borders, cultures, and languages."
    </p>
</div>

<!-- About & Portrait Section -->
<div class="grid md:grid-cols-2 gap-12 items-center mb-24">
    <div class="border-l-4 border-[#4E0707] pl-8">
        <h3 class="text-3xl font-bold mb-6 text-[#1A237E]">Academic Profile</h3>
        <p class="mb-6 text-gray-800 leading-relaxed">
            Dr. Ghulam Yaseen’s work delves into the deep roots of literary history, 
            connecting ancient manuscripts with modern thought. As a specialist in the 
            Global Anglophone Novel, his research explores the transitions of civilizations 
            through the lens of world literature.
        </p>
        <div class="flex space-x-4">
            <a href="#archive" class="bg-[#4E0707] text-white px-8 py-3 rounded-sm uppercase tracking-widest text-[10px] hover:bg-[#1A237E] transition duration-500 shadow-lg">
                Explore Archive
            </a>
        </div>
    </div>

    <div class="bg-white p-4 shadow-2xl rotate-2 border border-gray-100">
        <!-- DYNAMIC PROFILE IMAGE -->
        @if($profile && $profile->profile_image)
            <img src="/images/profile/{{ $profile->profile_image }}" alt="Dr. Ghulam Yaseen" class="w-full aspect-[3/4] object-cover grayscale hover:grayscale-0 transition duration-700 shadow-inner">
        @else
            <div class="bg-gray-100 aspect-[3/4] flex items-center justify-center border border-gray-200">
                <span class="text-gray-400 italic font-serif text-sm">Portrait of the Scholar</span>
            </div>
        @endif
    </div>
</div>

<!-- DYNAMIC RESEARCH INTERESTS (Module 1) -->
<div class="py-20 border-t border-b border-[#1A237E]/10 my-20 bg-white/30">
    <h3 class="text-xs uppercase tracking-[0.5em] font-bold text-[#4E0707] text-center mb-12">Primary Research Interests</h3>
    <div class="flex flex-wrap justify-center gap-6 max-w-4xl mx-auto px-4">
        @if($profile && $profile->research_interests)
            @foreach(explode(',', $profile->research_interests) as $interest)
                <span class="bg-white border border-[#1A237E]/30 px-6 py-4 text-[11px] font-bold text-[#1A237E] uppercase tracking-[0.2em] shadow-sm hover:border-[#4E0707] hover:text-[#4E0707] transition duration-500">
                    {{ trim($interest) }}
                </span>
            @endforeach
        @else
            <p class="text-gray-400 italic text-sm">Awaiting Research Interests from the Scholar...</p>
        @endif
    </div>
</div>

<!-- Recent Publications & Creative Work Section -->
<div id="archive" class="mt-20">
    <div class="flex justify-between items-end mb-12 border-b-2 border-[#1A237E]/10 pb-4">
        <h3 class="text-4xl font-bold text-[#1A237E]">Recent Archive</h3>
        <span class="text-xs uppercase tracking-[0.3em] text-[#4E0707] font-bold pb-1">Scholarly & Creative Work</span>
    </div>

    <div class="grid md:grid-cols-2 gap-10">
        @foreach($publications as $pub)
            <div class="bg-white p-8 shadow-xl border-t-4 border-[#4E0707] flex flex-col justify-between hover:translate-y-[-5px] transition duration-300">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-[#F5F5DC] text-[#4E0707] px-3 py-1 text-[10px] uppercase font-bold tracking-widest border border-[#4E0707]/20">
                            {{ $pub->category == 'scholarly' ? 'Research Paper' : 'Creative Yaseen' }}
                        </span>
                        <span class="text-[10px] text-gray-400">{{ $pub->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <h4 class="text-2xl font-bold mb-4 leading-tight text-gray-900">{{ $pub->title }}</h4>
                    
                    <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">
                        {{ Str::limit($pub->description, 150) }}
                    </p>

                    @if($pub->citation)
                        <div class="mb-6 p-3 bg-[#F5F5DC]/50 text-[11px] font-serif border-l-2 border-[#1A237E] text-gray-700 italic text-gray-700">
                            <strong>Citation:</strong> {{ $pub->citation }}
                        </div>
                    @endif
                </div>

                <!-- Read More Link -->
                <div class="pt-4 border-t border-gray-100">
                    <a href="{{ route('article.read', $pub->id) }}" class="inline-flex items-center text-[#1A237E] font-bold text-xs uppercase tracking-widest hover:text-[#4E0707] transition group">
                        Read Full Article 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection