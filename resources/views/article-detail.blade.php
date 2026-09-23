<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} — UNAISOC</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('UNAISOC_LOGO.png') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font: Geist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Geist', 'sans-serif'],
                        'Geist': ['Geist', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Geist', sans-serif; }
    </style>
</head>
<body class="bg-neutral-50 text-neutral-800 antialiased selection:bg-sky-500 selection:text-white">

<!-- Mobile Sticky Top Bar (Mobile Article Detail v2) -->
<header class="md:hidden sticky top-0 z-40 h-12 px-4 bg-white border-b border-zinc-300 flex justify-between items-center w-full shadow-xs">
  <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}" class="flex items-center gap-1.5 text-neutral-800 text-sm font-medium font-['Geist'] hover:text-neutral-600 transition">
    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="m15 18-6-6 6-6"/>
    </svg>
    <span>Back</span>
  </a>
  <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5">
    <img class="size-6 object-contain" src="{{ asset('UNAISOC_LOGO.png') }}" alt="UNAISOC" />
    <span class="text-neutral-800 text-base font-extrabold font-['Geist'] tracking-tight">UNAISOC</span>
  </a>
  <div class="w-12"></div>
</header>

<div class="w-full min-h-screen bg-neutral-50 flex justify-start items-start">
  
  <!-- Desktop Sidebar -->
  <aside class="hidden md:flex w-60 min-h-screen self-stretch px-6 pt-10 pb-6 bg-white border-r border-zinc-300 flex-col justify-between items-start shrink-0 sticky top-0 h-screen overflow-y-auto">
    <div class="self-stretch flex flex-col justify-start items-start gap-9">
      
      <!-- Brand Logo -->
      <div class="pl-2 inline-flex justify-start items-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 hover:opacity-90 transition">
          <img class="size-8 object-contain" src="{{ asset('UNAISOC_LOGO.png') }}" alt="UNAISOC" />
          <span class="justify-start text-neutral-800 text-xl font-extrabold font-['Geist'] tracking-tight">
            UNAISOC
          </span>
        </a>
      </div>

      <!-- Navigation Links -->
      <nav class="self-stretch flex flex-col justify-start items-start gap-2">
        
        <!-- Home (Active) -->
        <a href="{{ route('home') }}" class="self-stretch p-3 bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
              <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-800 text-base font-bold font-['Geist']">Home</div>
        </a>

        <!-- Search -->
        <a href="{{ route('search') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.3-4.3"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Search</div>
        </a>

        @auth
          <!-- Create (Admin) -->
          <a href="{{ route('articles.create') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
            <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
              <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="3" rx="2"/>
                <path d="M12 8v8"/>
                <path d="M8 12h8"/>
              </svg>
            </div>
            <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Create</div>
          </a>

          <!-- Admin Profile (Admin) -->
          <a href="{{ route('articles.index') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
            <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
              <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="5"/>
                <path d="M20 21a8 8 0 0 0-16 0"/>
              </svg>
            </div>
            <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Admin Profile</div>
          </a>
        @else
          <!-- Admin Login (Guest) -->
          <a href="{{ route('login') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
            <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
              <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                <polyline points="10 17 15 12 10 7"/>
                <line x1="15" x2="3" y1="12" y2="12"/>
              </svg>
            </div>
            <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Admin Login</div>
          </a>
        @endauth

      </nav>
    </div>

    <!-- Desktop Bottom Actions -->
    @auth
      <div class="self-stretch flex flex-col justify-start items-start gap-2 pt-6">
        <a href="{{ route('admin.settings') }}" class="self-stretch p-3 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-5 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Settings</div>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="w-full">
          @csrf
          <button type="submit" class="w-full self-stretch p-3 hover:bg-rose-50 rounded-lg inline-flex justify-start items-center gap-4 transition cursor-pointer text-left">
            <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
              <svg class="size-4 text-rose-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" x2="9" y1="12" y2="12"/>
              </svg>
            </div>
            <div class="justify-start text-rose-500 text-base font-medium font-['Geist']">Logout</div>
          </button>
        </form>
      </div>
    @else
      <div class="self-stretch h-24"></div>
    @endauth

  </aside>

  <!-- Article Detail Main Area -->
  <main class="flex-1 self-stretch p-4 md:pt-10 md:pb-16 pb-24 flex flex-col justify-start items-center overflow-y-auto">
    <div class="w-full md:w-[720px] p-4 md:p-10 bg-white rounded-xl md:rounded-2xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start gap-5 md:gap-7 shadow-xs">
      
      <!-- Thumbnail Image (Mobile h-52, Desktop h-96) -->
      @if($article->thumbnail)
        <img class="self-stretch h-52 md:h-96 w-full object-cover rounded-lg" src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" />
      @else
        <div class="self-stretch h-52 md:h-96 w-full bg-neutral-100 rounded-lg flex items-center justify-center text-neutral-400">
          <svg class="size-12 md:size-16 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect width="18" height="18" x="3" y="3" rx="2"/>
            <circle cx="9" cy="9" r="2"/>
            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
          </svg>
        </div>
      @endif

      <!-- Author & Category Meta Bar -->
      <div class="self-stretch pb-3 md:pb-4 border-b border-zinc-300 inline-flex justify-between items-center">
        <div class="flex justify-start items-center gap-2 md:gap-3">
          @if($article->author?->avatar)
            <img class="size-8 md:size-10 rounded-full object-cover shrink-0 outline outline-1 outline-zinc-200" src="{{ asset('storage/' . $article->author->avatar) }}" alt="{{ $article->author->name }}" />
          @else
            <div class="size-8 md:size-10 rounded-full bg-neutral-200 flex justify-center items-center overflow-hidden shrink-0 text-neutral-700 font-bold text-xs md:text-sm">
              {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
            </div>
          @endif
          <div class="inline-flex flex-col justify-start items-start">
            @if($article->author)
              <a href="{{ route('author.show', $article->author->id) }}" class="justify-start text-neutral-800 text-xs md:text-base font-semibold font-['Geist'] hover:text-sky-600 transition">
                {{ $article->author->name }}
              </a>
            @else
              <span class="justify-start text-neutral-800 text-xs md:text-base font-semibold font-['Geist']">
                Marcus Sterling
              </span>
            @endif
          </div>
        </div>
        
        <div class="flex justify-start items-center gap-2 md:gap-3">
          <div class="px-2 py-0.5 md:px-2.5 md:py-[5px] bg-neutral-100 rounded-sm md:rounded-md flex justify-start items-start">
            <div class="justify-start text-neutral-500 text-[9px] md:text-xs font-bold font-['Geist'] uppercase tracking-wider">
              {{ $article->category->name ?? 'General' }}
            </div>
          </div>
          <div class="justify-start text-neutral-400 text-xs font-normal font-['Geist']">
            {{ $article->created_at->format('M d, Y') }}
          </div>
        </div>
      </div>

      <!-- Article Title -->
      <h1 class="self-stretch justify-start text-neutral-800 text-xl md:text-3xl font-extrabold font-['Geist'] leading-7 md:leading-10">
        {{ $article->title }}
      </h1>

      <!-- Article Content Body (supports formatted text) -->
      <div class="self-stretch flex flex-col justify-start items-start gap-4">
        <div class="self-stretch justify-start text-neutral-800 text-sm md:text-base font-normal font-['Geist'] leading-6 md:leading-7 article-body">
          {!! $article->content !!}
        </div>
      </div>

    </div>
  </main>

</div>

<!-- Mobile Bottom Navigation Bar -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 h-14 px-8 bg-white border-t border-zinc-300 flex justify-around items-center z-50 shadow-sm">
  <a href="{{ route('home') }}" class="inline-flex flex-col justify-center items-center gap-1 text-sky-500">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
      <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    <span class="text-[10px] font-bold font-['Geist']">Feed</span>
  </a>

  <a href="{{ route('search') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="11" cy="11" r="8"/>
      <path d="m21 21-4.3-4.3"/>
    </svg>
    <span class="text-[10px] font-medium font-['Geist']">Search</span>
  </a>

  @auth
    <a href="{{ route('articles.create') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
      <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect width="18" height="18" x="3" y="3" rx="2"/>
        <path d="M12 8v8"/>
        <path d="M8 12h8"/>
      </svg>
      <span class="text-[10px] font-medium font-['Geist']">Create</span>
    </a>

    <a href="{{ route('articles.index') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
      <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="8" r="5"/>
        <path d="M20 21a8 8 0 0 0-16 0"/>
      </svg>
      <span class="text-[10px] font-medium font-['Geist']">Admin</span>
    </a>
  @endauth
</nav>

</body>
</html>