@extends('layout')

@section('content')
<div class="mb-16 border-b-4 border-[#1A237E] pb-6">
    <h2 class="text-6xl font-bold text-[#1A237E]">Publication & Research</h2>
    <p class="italic text-gray-600 mt-2 font-serif text-lg">Scholarly contributions to the Global Anglophone Novel and Literary History.</p>
</div>

<div class="space-y-12">
    @forelse($publications as $pub)
        <div class="bg-white p-10 shadow-2xl border-l-8 border-[#1A237E] group hover:bg-[#F5F5DC]/30 transition duration-500">
            <div class="flex justify-between items-start mb-4">
                <span class="text-[10px] uppercase font-bold tracking-[0.3em] text-[#4E0707]">Scholarly Work</span>
                <span class="text-[10px] text-gray-400">{{ $pub->created_at->format('Y') }}</span>
            </div>
            
            <h4 class="text-3xl font-bold text-gray-900 mb-4 leading-tight group-hover:text-[#1A237E] transition">{{ $pub->title }}</h4>
            <p class="text-gray-700 text-sm leading-relaxed mb-6 font-serif italic">{{ $pub->description }}</p>

            @if($pub->citation)
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 text-xs font-serif italic text-gray-600">
                    <strong>Citation:</strong> {{ $pub->citation }}
                </div>
            @endif

            <a href="{{ route('article.read', $pub->id) }}" class="inline-flex items-center text-[#1A237E] font-bold text-xs uppercase tracking-widest hover:text-[#4E0707] transition">
                Read Abstract & Analysis <i class="fa-solid fa-arrow-right ml-2 text-[10px]"></i>
            </a>
        </div>
    @empty
        <p class="text-center py-20 text-gray-400 italic">No scholarly publications found.</p>
    @endforelse
</div>
@endsection