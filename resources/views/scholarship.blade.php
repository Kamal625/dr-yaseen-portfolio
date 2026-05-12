@extends('layout')

@section('content')
<div class="mb-16 border-b-4 border-[#4E0707] pb-6">
    <h2 class="text-6xl font-bold text-[#4E0707]">Public Scholarship</h2>
    <p class="italic text-gray-600 mt-2 font-serif text-lg">Creative explorations, literary essays, and cultural discussions.</p>
</div>

<div class="grid md:grid-cols-2 gap-10">
    @forelse($publications as $pub)
        <div class="bg-white p-8 shadow-xl border-t-8 border-[#4E0707] flex flex-col justify-between">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-[#1A237E] block mb-4 italic">Creative Yaseen</span>
                <h4 class="text-2xl font-bold text-gray-900 mb-4 leading-tight">{{ $pub->title }}</h4>
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    {{ Str::limit($pub->description, 200) }}
                </p>
            </div>
            
            <div class="pt-4 border-t border-gray-100">
                <a href="{{ route('article.read', $pub->id) }}" class="text-[#4E0707] font-bold text-xs uppercase tracking-widest hover:text-[#1A237E] transition">
                    Read Full Piece →
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-2 text-center py-20 text-gray-400 italic">No creative essays found.</div>
    @endforelse
</div>
@endsection