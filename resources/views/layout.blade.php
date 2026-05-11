<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Ghulam Yaseen | Scholar of Global Anglophone Novel</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Official portfolio of Dr. Ghulam Yaseen, Scholar of Global Anglophone Novel. Exploring literary history, ancient manuscripts, and world literature.">
    <meta name="keywords" content="Dr. Ghulam Yaseen, Literary Historian, Global Anglophone Novel, Literature Scholar, Academic Archive">
    <meta name="author" content="Dr. Ghulam Yaseen">
    
    <!-- Vite for Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

    <!-- ICONS LIBRARY (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --oxford-blue: #1A237E;
            --deep-burgundy: #4E0707;
            --parchment: #F5F5DC;
        }

        body {
            font-family: 'Lora', serif;
            background-color: var(--parchment);
            color: #1a1a1a;
            line-height: 1.7;
        }

        h1, h2, h3, h4, .font-serif-display {
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.02em;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--parchment); }
        ::-webkit-scrollbar-thumb { background: var(--oxford-blue); }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- Top Border Line -->
    <div class="h-2 w-full bg-[#4E0707]"></div>

    <!-- Navigation -->
    <nav class="bg-[#1A237E] text-white shadow-2xl py-6">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            
            <!-- Brand Identity -->
            <div class="text-center md:text-left mb-6 md:mb-0">
                <a href="/" class="text-3xl font-bold tracking-widest uppercase font-serif-display block">
                    Dr. Ghulam Yaseen
                </a>
                <p class="text-[10px] uppercase tracking-[0.25em] text-slate-300 mt-1 italic">
                    Scholar of Global Anglophone Novel
                </p>
            </div>
            
            <!-- Menu Links -->
            <ul class="flex flex-wrap justify-center items-center space-x-6 md:space-x-8 text-sm uppercase tracking-widest font-medium">
                <li><a href="/" class="hover:text-[#F5F5DC] transition border-b border-transparent hover:border-[#4E0707] pb-1">Home</a></li>
                <li><a href="{{ route('gallery.index') }}" class="hover:text-[#F5F5DC] transition border-b border-transparent hover:border-[#4E0707] pb-1">Archive</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-[#F5F5DC] transition border-b border-transparent hover:border-[#4E0707] pb-1">Contact</a></li>

                @auth
                    <!-- Sirf Admin ko nazar ayega jab login hoga -->
                    <li class="pl-4 border-l border-white/20">
                        <a href="/admin" class="text-amber-400 font-bold hover:text-white transition">Dashboard</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-[#4E0707] px-3 py-1 text-[10px] text-white hover:bg-white hover:text-[#4E0707] transition font-bold uppercase border border-[#4E0707]">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow container mx-auto px-6 py-12 max-w-5xl">
        @yield('content')
    </main>

    <!-- DYNAMIC FOOTER -->
    @php $profile = \App\Models\Profile::first(); @endphp
    
    <footer class="bg-[#1A237E] text-[#F5F5DC] py-16 border-t-4 border-[#4E0707] mt-24">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-12 text-center md:text-left">
            
            <!-- About Section -->
            <div>
                <h3 class="text-xl font-bold font-serif-display mb-4 italic">Dr. Ghulam Yaseen</h3>
                <p class="text-[10px] opacity-70 leading-relaxed uppercase tracking-wider">
                    Scholar of Global Anglophone Novel.
                </p>
            </div>

            <!-- Follow My Work (With Icons) -->
            <div>
                <h3 class="text-xs uppercase tracking-[0.3em] font-bold mb-8 text-white">FOLLOW MY WORK</h3>
                <div class="flex flex-wrap justify-center md:justify-start gap-4">
                    @if($profile)
                        @if($profile->google_scholar) 
                            <a href="{{ $profile->google_scholar }}" target="_blank" title="Google Scholar" class="w-10 h-10 flex items-center justify-center border border-white/20 hover:bg-[#4E0707] transition duration-500 rounded-full">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </a> 
                        @endif
                        @if($profile->linkedin) 
                            <a href="{{ $profile->linkedin }}" target="_blank" title="LinkedIn" class="w-10 h-10 flex items-center justify-center border border-white/20 hover:bg-[#0077b5] transition duration-500 rounded-full">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a> 
                        @endif
                        @if($profile->researchgate) 
                            <a href="{{ $profile->researchgate }}" target="_blank" title="ResearchGate" class="w-10 h-10 flex items-center justify-center border border-white/20 hover:bg-[#00ccbb] transition duration-500 rounded-full">
                                <i class="fa-brands fa-researchgate"></i>
                            </a> 
                        @endif
                        @if($profile->orcid) 
                            <a href="{{ $profile->orcid }}" target="_blank" title="ORCID" class="w-10 h-10 flex items-center justify-center border border-white/20 hover:bg-[#a6ce39] transition duration-500 rounded-full">
                                <i class="fa-brands fa-orcid"></i>
                            </a> 
                        @endif
                        @if($profile->youtube) 
                            <a href="{{ $profile->youtube }}" target="_blank" title="YouTube" class="w-10 h-10 flex items-center justify-center border border-white/20 hover:bg-[#ff0000] transition duration-500 rounded-full">
                                <i class="fa-brands fa-youtube"></i>
                            </a> 
                        @endif
                    @else
                        <span class="text-[9px] opacity-40 uppercase tracking-widest italic">Academic Presence</span>
                    @endif
                </div>
            </div>

            <!-- Newsletter / Substack -->
            <div>
                <h3 class="text-xs uppercase tracking-[0.3em] font-bold mb-6 text-white">Newsletter</h3>
                <p class="text-[9px] mb-4 opacity-70 uppercase tracking-wider italic font-serif">Join my Substack for weekly insights</p>
                @if($profile && $profile->substack)
                    <a href="{{ $profile->substack }}" target="_blank" class="bg-[#4E0707] text-white px-6 py-2 text-[10px] uppercase font-bold tracking-[0.2em] inline-block hover:bg-white hover:text-[#4E0707] transition shadow-lg">
                       <i class="fa-solid fa-envelope-open-text mr-2"></i> Visit Substack
                    </a>
                @else
                    <a href="#" class="bg-white/10 text-white px-6 py-2 text-[10px] uppercase font-bold tracking-[0.2em] inline-block opacity-30">Coming Soon</a>
                @endif
            </div>

        </div>
        
        <div class="text-center mt-12 pt-8 border-t border-white/10 text-[10px] uppercase tracking-[0.4em] opacity-40">
            &copy; {{ date('Y') }} Dr. Ghulam Yaseen. All Rights Reserved.
        </div>
    </footer>

</body>
</html>