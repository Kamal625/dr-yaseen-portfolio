@extends('layout')

@section('content')
<article class="max-w-3xl mx-auto bg-white p-10 shadow-2xl border-t-8 border-[#4E0707]">
    <span class="text-xs uppercase tracking-[0.3em] text-[#4E0707] font-bold">{{ $article->category }}</span>
    <h1 class="text-5xl font-bold mt-4 mb-8 leading-tight">{{ $article->title }}</h1>
    
    <div class="prose prose-lg lg:prose-xl font-serif text-gray-800 leading-relaxed">
        {!! $article->content !!}
    </div>

    <div class="mt-12 pt-6 border-t border-gray-200">
        <a href="/" class="text-[#1A237E] font-bold uppercase tracking-widest text-xs">← Back to Archive</a>
    </div>
</article>
@endsection