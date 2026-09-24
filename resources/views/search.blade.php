<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search — UNAISOC</title>
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
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-neutral-50 text-neutral-800 antialiased selection:bg-sky-500 selection:text-white">

<!-- Mobile Sticky Top Bar & Filters (Mobile Search & Filter v2) -->
<header class="md:hidden sticky top-0 z-40 bg-white border-b border-zinc-300 w-full p-4 flex flex-col gap-3 shadow-xs">
  <!-- Search Input Form -->
  <form action="{{ route('search') }}" method="GET" class="self-stretch px-3.5 py-2.5 bg-neutral-50 rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 inline-flex justify-start items-center gap-2.5">
    @if(request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    <div class="size-4 flex justify-center items-center text-neutral-400 shrink-0">
      <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/>
        <path d="m21 21-4.3-4.3"/>
      </svg>
    </div>
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles by keywords..." class="flex-1 text-neutral-800 text-sm font-normal font-['Geist'] bg-transparent outline-none placeholder-neutral-400">
    @if(request('q'))
      <a href="{{ route('search', array_filter(['category' => request('category')])) }}" class="text-neutral-400 hover:text-neutral-600">
        <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 6 6 18M6 6l12 12"/>
        </svg>
      </a>
    @endif
  </form>

  <!-- Horizontal Scrollable Category Filter Pills -->
  <div class="self-stretch inline-flex justify-start items-start gap-2 overflow-x-auto no-scrollbar py-0.5">
    <a href="{{ route('search', array_filter(['q' => request('q')])) }}" 
       class="shrink-0 px-3 py-1.5 {{ !request('category') ? 'bg-neutral-800 text-white' : 'bg-white text-neutral-500 outline outline-1 outline-offset-[-1px] outline-zinc-300' }} rounded-2xl flex justify-start items-center transition">
      <div class="text-xs font-semibold font-['Geist']">All</div>
    </a>
    @foreach($categories as $category)
      <a href="{{ route('search', array_filter(['category' => $category->id, 'q' => request('q')])) }}" 
         class="shrink-0 px-3 py-1.5 {{ request('category') == $category->id ? 'bg-neutral-800 text-white' : 'bg-white text-neutral-500 outline outline-1 outline-offset-[-1px] outline-zinc-300' }} rounded-2xl flex justify-start items-center transition">
        <div class="text-xs font-semibold font-['Geist']">{{ $category->name }}</div>
      </a>
    @endforeach
  </div>
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
        
        <!-- Home -->
        <a href="{{ route('home') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
              <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Home</div>
        </a>

        <!-- Search (Active) -->
        <a href="{{ route('search') }}" class="self-stretch p-3 bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.3-4.3"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-800 text-base font-bold font-['Geist']">Search</div>
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

  <!-- Main Search & Explore Area -->
  <main class="flex-1 self-stretch px-4 py-6 md:px-14 md:py-10 pb-24 md:pb-12 flex flex-col justify-start items-start gap-6 md:gap-8 overflow-y-auto">
    
    <!-- Desktop Search Bar & Filters (Hidden on Mobile) -->
    <div class="hidden md:flex self-stretch flex-col justify-start items-center gap-5">
      <form action="{{ route('search') }}" method="GET" class="w-[640px] px-4 py-3 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 inline-flex justify-start items-center gap-3 shadow-sm">
        @if(request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <div class="size-4 inline-flex flex-col justify-center items-center overflow-hidden text-neutral-400">
          <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.3-4.3"/>
          </svg>
        </div>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search articles by keywords..." class="flex-1 text-neutral-800 text-base font-normal font-['Geist'] bg-transparent outline-none placeholder-neutral-400">
        @if(request('q'))
          <a href="{{ route('search', array_filter(['category' => request('category')])) }}" class="text-neutral-400 hover:text-neutral-600">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 6 6 18M6 6l12 12"/>
            </svg>
          </a>
        @endif
      </form>

      <!-- Category Filter Pills -->
      <div class="inline-flex justify-start items-start gap-2 flex-wrap">
        <a href="{{ route('search', array_filter(['q' => request('q')])) }}" 
           class="px-4 py-2 {{ !request('category') ? 'bg-neutral-800 text-white outline-neutral-800' : 'bg-white text-neutral-500 outline-zinc-300 hover:text-neutral-800' }} rounded-[20px] outline outline-1 outline-offset-[-1px] flex justify-start items-center transition">
          <div class="text-xs font-semibold font-['Geist']">All</div>
        </a>
        @foreach($categories as $category)
          <a href="{{ route('search', array_filter(['category' => $category->id, 'q' => request('q')])) }}" 
             class="px-4 py-2 {{ request('category') == $category->id ? 'bg-neutral-800 text-white outline-neutral-800' : 'bg-white text-neutral-500 outline-zinc-300 hover:text-neutral-800' }} rounded-[20px] outline outline-1 outline-offset-[-1px] flex justify-start items-center transition">
            <div class="text-xs font-semibold font-['Geist']">{{ $category->name }}</div>
          </a>
        @endforeach
      </div>
    </div>

    @if(!$hasSearch)
      <!-- Explore Articles Section (shown only before search) -->
      <div class="self-stretch flex flex-col justify-start items-start gap-4 md:gap-6">
        <div class="justify-start text-neutral-800 text-sm md:text-base font-bold font-['Geist'] uppercase md:normal-case tracking-wide md:tracking-normal">Explore Articles</div>
        
        <!-- Mobile Explore Cards (Compact Horizontal List) -->
        <div class="md:hidden self-stretch flex flex-col gap-3">
          @forelse($exploreArticles as $explore)
            <a href="{{ route('blog.show', $explore->slug) }}" class="self-stretch p-2.5 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 inline-flex justify-start items-center gap-3 hover:bg-neutral-50 transition">
              @if($explore->thumbnail)
                <img class="size-20 rounded-md object-cover shrink-0" src="{{ $explore->thumbnail_url }}" alt="{{ $explore->title }}" />
              @else
                <div class="size-20 rounded-md bg-neutral-100 flex items-center justify-center text-neutral-400 shrink-0">
                  <svg class="size-6 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                  </svg>
                </div>
              @endif
              <div class="flex-1 min-w-0 inline-flex flex-col justify-start items-start gap-1">
                <div class="inline-flex justify-start items-center gap-2">
                  <div class="px-1.5 py-0.5 bg-neutral-100 rounded-sm flex justify-start items-start">
                    <span class="text-neutral-500 text-[9px] font-bold font-['Geist'] uppercase">{{ $explore->category->name ?? 'General' }}</span>
                  </div>
                  <span class="text-neutral-400 text-xs font-normal font-['Geist']">{{ $explore->created_at->format('M d') }}</span>
                </div>
                <div class="self-stretch text-neutral-800 text-xs font-bold font-['Geist'] line-clamp-2 leading-tight">
                  {{ $explore->title }}
                </div>
              </div>
            </a>
          @empty
            <div class="text-neutral-400 text-xs">No articles available to explore yet.</div>
          @endforelse
        </div>

        <!-- Desktop Explore Grid (3 Columns) -->
        <div class="hidden md:grid self-stretch grid-cols-3 gap-6">
          @forelse($exploreArticles as $explore)
            <a href="{{ route('blog.show', $explore->slug) }}" class="bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start overflow-hidden hover:shadow-md transition group">
              @if($explore->thumbnail)
                <img class="self-stretch h-48 w-full object-cover group-hover:scale-[1.01] transition" src="{{ $explore->thumbnail_url }}" alt="{{ $explore->title }}" />
              @else
                <div class="self-stretch h-48 w-full bg-neutral-100 flex items-center justify-center text-neutral-400">
                  <svg class="size-8 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <circle cx="9" cy="9" r="2"/>
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                  </svg>
                </div>
              @endif
              <div class="self-stretch p-4 flex flex-col justify-start items-start gap-2.5">
                <div class="self-stretch inline-flex justify-between items-center">
                  <div class="px-1.5 py-[3px] bg-neutral-100 rounded-sm flex justify-start items-start">
                    <div class="justify-start text-neutral-500 text-[10px] font-bold font-['Geist'] uppercase">
                      {{ $explore->category->name ?? 'Technology' }}
                    </div>
                  </div>
                  <div class="justify-start text-neutral-400 text-xs font-normal font-['Geist']">
                    {{ $explore->created_at->format('M d, Y') }}
                  </div>
                </div>
                <div class="self-stretch justify-start text-neutral-800 text-base font-bold font-['Geist'] leading-5 line-clamp-2 group-hover:text-sky-600 transition">
                  {{ $explore->title }}
                </div>
              </div>
            </a>
          @empty
            <div class="col-span-3 text-neutral-400 text-sm">No articles available to explore yet.</div>
          @endforelse
        </div>
      </div>

      <div class="self-stretch h-px bg-zinc-300"></div>
    @endif

    <!-- Search Results / Empty State -->
    @if(isset($hasSearch) && $hasSearch && $articles->count() > 0)
      <div class="self-stretch flex flex-col justify-start items-start gap-4 md:gap-6">
        <div class="justify-start text-neutral-800 text-sm md:text-base font-bold font-['Geist'] uppercase md:normal-case tracking-wide md:tracking-normal">Search Results</div>
        
        <!-- Mobile Search Results (Compact Horizontal List matching mobile-search-filter-v2) -->
        <div class="md:hidden self-stretch flex flex-col gap-3">
          @foreach($articles as $article)
            <a href="{{ route('blog.show', $article->slug) }}" class="self-stretch p-2.5 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 inline-flex justify-start items-center gap-3 hover:bg-neutral-50 transition">
              @if($article->thumbnail)
                <img class="size-20 rounded-md object-cover shrink-0" src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" />
              @else
                <div class="size-20 rounded-md bg-neutral-100 flex items-center justify-center text-neutral-400 shrink-0">
                  <svg class="size-6 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                  </svg>
                </div>
              @endif
              <div class="flex-1 min-w-0 inline-flex flex-col justify-start items-start gap-1">
                <div class="inline-flex justify-start items-center gap-2">
                  <div class="px-1.5 py-0.5 bg-neutral-100 rounded-sm flex justify-start items-start">
                    <span class="text-neutral-500 text-[9px] font-bold font-['Geist'] uppercase">{{ $article->category->name ?? 'General' }}</span>
                  </div>
                  <span class="text-neutral-400 text-xs font-normal font-['Geist']">{{ $article->created_at->format('M d') }}</span>
                </div>
                <div class="self-stretch text-neutral-800 text-xs font-bold font-['Geist'] line-clamp-2 leading-tight">
                  {{ $article->title }}
                </div>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Desktop Search Results (Grid 2 Columns) -->
        <div class="hidden md:grid self-stretch grid-cols-2 gap-6">
          @foreach($articles as $article)
            <a href="{{ route('blog.show', $article->slug) }}" class="bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start overflow-hidden hover:shadow-md transition group">
              @if($article->thumbnail)
                <img class="self-stretch h-48 w-full object-cover" src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" />
              @endif
              <div class="self-stretch p-5 flex flex-col gap-2">
                <div class="flex justify-between items-center text-xs text-neutral-400">
                  <span class="text-neutral-500 font-bold uppercase">{{ $article->category->name ?? 'General' }}</span>
                  <span>{{ $article->created_at->format('M d, Y') }}</span>
                </div>
                <h3 class="text-neutral-800 font-bold text-base leading-snug group-hover:text-sky-600 transition">{{ $article->title }}</h3>
                <p class="text-neutral-500 text-xs line-clamp-2">{{ Str::limit(strip_tags($article->content), 120) }}</p>
              </div>
            </a>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="self-stretch pt-4 flex justify-center">
          {{ $articles->links() }}
        </div>
      </div>
    @elseif(isset($hasSearch) && $hasSearch)
      <!-- Empty State matching exact Figma mobile-search-filter-v2 & desktop -->
      <div class="self-stretch p-8 md:p-12 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-center gap-3 md:gap-4">
        <div class="size-7 md:size-8 flex flex-col justify-center items-center overflow-hidden">
          <svg class="size-6 text-neutral-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="m21 21-4.3-4.3"/>
          </svg>
        </div>
        <div class="flex flex-col justify-start items-center gap-1 text-center">
          <div class="text-neutral-800 text-sm md:text-base font-semibold font-['Geist']">No articles found matching your search</div>
          <div class="text-neutral-500 text-xs md:text-sm font-normal font-['Geist']">Try adjusting your search criteria or select another filter.</div>
        </div>
        <a href="{{ route('search') }}" class="px-3.5 py-1.5 md:px-4 md:py-2 rounded-md outline outline-1 outline-offset-[-1px] outline-neutral-800 inline-flex justify-start items-start hover:bg-neutral-100 transition cursor-pointer">
          <div class="justify-start text-neutral-800 text-xs font-semibold font-['Geist']">Clear Filters</div>
        </a>
      </div>
    @endif

  </main>

</div>

<!-- Mobile Bottom Navigation Bar (Search Active) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 h-14 px-8 bg-white border-t border-zinc-300 flex justify-around items-center z-50 shadow-sm">
  <a href="{{ route('home') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
      <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    <span class="text-[10px] font-medium font-['Geist']">Feed</span>
  </a>

  <a href="{{ route('search') }}" class="inline-flex flex-col justify-center items-center gap-1 text-sky-500">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="11" cy="11" r="8"/>
      <path d="m21 21-4.3-4.3"/>
    </svg>
    <span class="text-[10px] font-bold font-['Geist']">Search</span>
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
