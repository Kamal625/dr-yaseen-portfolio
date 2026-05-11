@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h2 class="text-5xl font-bold text-[#1A237E] mb-4">Get In Touch</h2>
        <div class="h-1 w-20 bg-[#4E0707] mx-auto mb-6"></div>
        <p class="italic text-gray-600 font-serif text-lg">For academic collaborations, guest lectures, or literary inquiries.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-12">
        <!-- Contact Info -->
        <div class="md:col-span-1 space-y-8">
            <div>
                <h4 class="text-xs uppercase tracking-[0.2em] font-bold text-[#4E0707] mb-2">Location</h4>
                <p class="text-sm text-gray-700 leading-relaxed">Department of English,<br>Academic Institution</p>
            </div>
            <div>
                <h4 class="text-xs uppercase tracking-[0.2em] font-bold text-[#4E0707] mb-2">Email</h4>
                <p class="text-sm text-gray-700">omaryaseenbaig@gmail.com</p>
            </div>
            <div class="pt-6 border-t border-gray-200">
                <p class="text-[10px] uppercase tracking-widest text-gray-400 leading-relaxed italic">
                    Response time is typically 2-3 business days for academic inquiries.
                </p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="md:col-span-2 bg-white p-8 shadow-2xl border-t-8 border-[#1A237E]">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-6 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full p-3 border border-gray-200 text-sm focus:ring-1 focus:ring-[#1A237E] outline-none bg-gray-50" required>
                    </div>
                    <div>
                        <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full p-3 border border-gray-200 text-sm focus:ring-1 focus:ring-[#1A237E] outline-none bg-gray-50" required>
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Subject / Nature of Inquiry</label>
                    <select name="subject" class="w-full p-3 border border-gray-200 text-sm bg-gray-50">
                        <option value="Research Collaboration">Research Collaboration</option>
                        <option value="Guest Lecture">Guest Lecture / Seminar</option>
                        <option value="Book Review">Book Review / Discussion</option>
                        <option value="General Inquiry">General Academic Inquiry</option>
                    </select>
                </div>

                <div>
                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-500 block mb-2">Message</label>
                    <textarea name="message" rows="5" class="w-full p-3 border border-gray-200 text-sm focus:ring-1 focus:ring-[#1A237E] outline-none bg-gray-50" placeholder="Please provide details of your inquiry..." required></textarea>
                </div>

                <button type="submit" class="bg-[#1A237E] text-white px-10 py-4 text-xs font-bold uppercase tracking-widest hover:bg-[#4E0707] transition duration-500 shadow-xl">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection