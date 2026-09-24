<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — UNAISOC</title>
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

<!-- Mobile Sticky Top Bar (Mobile Admin Dashboard v2) -->
<header class="md:hidden sticky top-0 z-40 h-12 px-4 bg-white border-b border-zinc-300 flex justify-between items-center w-full shadow-xs">
  <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
    <img class="size-7 object-contain" src="{{ asset('UNAISOC_LOGO.png') }}" alt="UNAISOC" />
    <span class="text-neutral-800 text-lg font-extrabold font-['Geist'] tracking-tight">UNAISOC</span>
  </a>
  <a href="{{ route('admin.settings') }}" class="text-neutral-600 hover:text-neutral-900 text-xs font-semibold font-['Geist'] px-2 py-1">Settings</a>
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

        <!-- Create -->
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

        <!-- Admin Profile (Active) -->
        <a href="{{ route('articles.index') }}" class="self-stretch p-3 bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="8" r="5"/>
              <path d="M20 21a8 8 0 0 0-16 0"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-800 text-base font-bold font-['Geist']">Admin Profile</div>
        </a>

      </nav>
    </div>

    <!-- Desktop Bottom Actions -->
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
  </aside>

  <!-- Admin Dashboard Main -->
  <main class="flex-1 self-stretch p-4 md:px-14 md:py-10 pb-24 md:pb-12 flex flex-col justify-start items-start gap-6 md:gap-9 overflow-y-auto">
    
    @if(session('success'))
      <div class="self-stretch p-3 md:p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs md:text-sm font-['Geist'] rounded-xl">
        {{ session('success') }}
      </div>
    @endif

    <!-- Profile Header Card (Responsive: Mobile matches mobile-admin-dashboard-v2, Desktop matches approved desktop layout) -->
    <div class="self-stretch p-4 md:p-8 bg-white rounded-xl md:rounded-2xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col md:flex-row justify-start items-start md:items-center gap-4 md:gap-12 shadow-sm">
      <div class="self-stretch inline-flex justify-between items-center w-full md:w-auto">
        <div class="inline-flex justify-start items-center gap-3 md:gap-4">
          @if(Auth::user()->avatar)
            <img class="size-12 md:size-24 rounded-full object-cover shrink-0 outline outline-1 outline-zinc-200" src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" />
          @else
            <div class="size-12 md:size-24 rounded-full bg-neutral-200 flex justify-center items-center overflow-hidden shrink-0 text-neutral-700 font-bold text-lg md:text-3xl">
              {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
          @endif
          <div class="inline-flex flex-col justify-start items-start gap-0.5">
            <div class="text-neutral-800 text-base md:text-xl font-bold font-['Geist']">{{ Auth::user()->name }}</div>
            <div class="px-1.5 py-0.5 md:px-2.5 md:py-1 bg-neutral-100 rounded-sm md:rounded-md flex justify-start items-start">
              <div class="text-sky-500 text-[10px] md:text-xs font-bold font-['Geist']">Chief Editor</div>
            </div>
          </div>
        </div>

        <!-- Mobile New Article button in header row -->
        <a href="{{ route('articles.create') }}" class="md:hidden px-3 py-2 bg-sky-500 hover:bg-sky-600 rounded-md flex justify-start items-center gap-1.5 text-white transition shadow-sm">
          <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M12 5v14M5 12h14"/>
          </svg>
          <span class="text-white text-xs font-bold font-['Geist']">New Article</span>
        </a>
      </div>
      
      <!-- Stats Area -->
      <div class="flex-1 inline-flex justify-start items-start gap-4 md:gap-6 pt-1 md:pt-0">
        <div class="flex justify-start items-start gap-1 md:gap-1.5">
          <div class="text-neutral-800 text-sm md:text-base font-bold font-['Geist']">{{ $publishedCount ?? $articles->total() }}</div>
          <div class="text-neutral-500 text-xs md:text-base font-normal font-['Geist']">Published</div>
        </div>
        <div class="flex justify-start items-start gap-1 md:gap-1.5">
          <div class="text-neutral-800 text-sm md:text-base font-bold font-['Geist']">{{ $draftsCount ?? 0 }}</div>
          <div class="text-neutral-500 text-xs md:text-base font-normal font-['Geist']">Drafts</div>
        </div>
      </div>

      <!-- Desktop New Article Button -->
      <a href="{{ route('articles.create') }}" class="hidden md:flex px-5 py-3 bg-sky-500 hover:bg-sky-600 rounded-lg justify-start items-center gap-2 text-white transition shadow-sm shrink-0">
        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M12 5v14M5 12h14"/>
        </svg>
        <span class="text-white text-sm font-bold font-['Geist']">New Article</span>
      </a>
    </div>

    <!-- Articles Section -->
    <div class="self-stretch flex flex-col justify-start items-start gap-4 md:gap-5">
      
      <!-- Tabs (Published Articles / Drafts) -->
      <div class="self-stretch border-b border-zinc-300 inline-flex justify-start items-start gap-4 md:gap-8">
        <a href="{{ route('articles.index') }}" class="pb-3 md:pb-4 {{ ($tab ?? 'published') !== 'drafts' ? 'border-b-2 border-neutral-800 text-neutral-800 font-bold' : 'text-neutral-400 hover:text-neutral-700 font-semibold' }} flex justify-start items-center gap-1.5 md:gap-2 transition">
          <svg class="size-3.5 md:size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect width="18" height="18" x="3" y="3" rx="2"/>
            <path d="M7 7h10M7 12h10M7 17h10"/>
          </svg>
          <span class="text-xs md:text-sm uppercase font-['Geist']">Published Articles ({{ $publishedCount ?? 0 }})</span>
        </a>
        <a href="{{ route('articles.index', ['tab' => 'drafts']) }}" class="pb-3 md:pb-4 {{ ($tab ?? 'published') === 'drafts' ? 'border-b-2 border-neutral-800 text-neutral-800 font-bold' : 'text-neutral-400 hover:text-neutral-700 font-semibold' }} flex justify-start items-center gap-1.5 md:gap-2 transition">
          <svg class="size-3.5 md:size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
          </svg>
          <span class="text-xs md:text-sm uppercase font-['Geist']">Drafts ({{ $draftsCount ?? 0 }})</span>
        </a>
      </div>

      <!-- Mobile Articles List (Cards matching mobile-admin-dashboard-v2) -->
      <div class="md:hidden self-stretch flex flex-col gap-3">
        @forelse($articles as $article)
          <div class="self-stretch p-3 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start gap-2.5 shadow-xs">
            <div class="self-stretch inline-flex justify-start items-center gap-3">
              @if($article->thumbnail)
                <img class="w-16 h-12 rounded-sm object-cover shrink-0" src="{{ $article->thumbnail_url }}" alt="" />
              @else
                <div class="w-16 h-12 rounded-sm bg-neutral-100 flex items-center justify-center text-neutral-400 shrink-0">
                  <svg class="size-5 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                  </svg>
                </div>
              @endif
              <div class="flex-1 min-w-0 inline-flex flex-col justify-start items-start gap-1">
                <a href="{{ route('blog.show', $article->slug) }}" class="self-stretch text-neutral-800 text-sm font-bold font-['Geist'] line-clamp-1 hover:text-sky-600 transition">
                  {{ $article->title }}
                </a>
                <div class="inline-flex justify-start items-center gap-2">
                  <div class="px-1.5 py-0.5 bg-neutral-100 rounded-sm flex justify-start items-start">
                    <span class="text-neutral-500 text-[9px] font-bold font-['Geist'] uppercase">{{ $article->category->name ?? 'General' }}</span>
                  </div>
                  <span class="text-neutral-400 text-xs font-normal font-['Geist']">{{ $article->created_at->format('M d') }}</span>
                  @if($article->status === 'draft')
                    <span class="px-1 py-0.2 bg-amber-100 text-amber-700 rounded text-[9px] font-bold uppercase font-['Geist']">Draft</span>
                  @endif
                </div>
              </div>
            </div>
            <div class="self-stretch inline-flex justify-end items-center gap-2 pt-1 border-t border-zinc-100">
              <a href="{{ route('articles.edit', $article->id) }}" class="px-3.5 py-1.5 bg-neutral-100 hover:bg-neutral-200 rounded-md flex justify-start items-start transition">
                <span class="text-neutral-800 text-xs font-semibold font-['Geist']">Edit</span>
              </a>
              <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3.5 py-1.5 bg-red-100 hover:bg-red-200 rounded-md flex justify-start items-start transition cursor-pointer">
                  <span class="text-rose-500 text-xs font-semibold font-['Geist']">Delete</span>
                </button>
              </form>
            </div>
          </div>
        @empty
          <div class="self-stretch p-8 bg-white rounded-xl outline outline-1 outline-zinc-300 text-center text-neutral-400 font-['Geist'] text-xs">
            No articles found in this tab. Click "New Article" to create one.
          </div>
        @endforelse
      </div>

      <!-- Desktop Articles Table Card -->
      <div class="hidden md:flex self-stretch bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex-col justify-start items-start overflow-hidden shadow-xs">
        
        <!-- Table Header -->
        <div class="self-stretch px-6 py-3.5 bg-neutral-100 inline-flex justify-start items-center gap-4">
          <div class="w-24 justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Thumbnail</div>
          <div class="flex-1 justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Article Title</div>
          <div class="w-36 justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Category</div>
          <div class="w-28 justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">{{ ($tab ?? 'published') === 'drafts' ? 'Last Saved' : 'Published Date' }}</div>
          <div class="w-40 text-right justify-end text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Actions</div>
        </div>

        <!-- Table Rows -->
        @forelse($articles as $article)
          <div class="self-stretch px-6 py-4 border-b border-zinc-200 inline-flex justify-start items-center gap-4 hover:bg-neutral-50/70 transition">
            <div class="w-24 shrink-0">
              @if($article->thumbnail)
                <img class="w-16 h-11 rounded-md object-cover" src="{{ $article->thumbnail_url }}" alt="" />
              @else
                <div class="w-16 h-11 rounded-md bg-neutral-100 flex items-center justify-center text-neutral-400">
                  <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <circle cx="9" cy="9" r="2"/>
                  </svg>
                </div>
              @endif
            </div>

            <div class="flex-1 justify-start text-neutral-800 text-sm font-semibold font-['Geist'] truncate flex items-center">
              <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-sky-600 transition truncate">
                {{ $article->title }}
              </a>
              @if($article->status === 'draft')
                <span class="ml-2 px-1.5 py-0.5 bg-amber-100 text-amber-700 rounded text-[10px] font-bold uppercase font-['Geist'] shrink-0">Draft</span>
              @endif
            </div>

            <div class="w-36 flex justify-start items-start">
              <div class="px-2 py-1 bg-neutral-100 rounded-sm flex justify-start items-start">
                <div class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">
                  {{ $article->category->name ?? 'General' }}
                </div>
              </div>
            </div>

            <div class="w-28 justify-start text-neutral-500 text-xs font-normal font-['Geist']">
              {{ $article->created_at->format('M d, Y') }}
            </div>

            <div class="w-40 flex justify-end items-center gap-3">
              <a href="{{ route('articles.edit', $article->id) }}" class="px-3 py-1.5 bg-neutral-100 hover:bg-neutral-200 rounded-md flex justify-start items-start transition">
                <span class="justify-start text-neutral-800 text-xs font-semibold font-['Geist']">Edit</span>
              </a>
              <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 rounded-md flex justify-start items-start transition cursor-pointer">
                  <span class="justify-start text-rose-500 text-xs font-semibold font-['Geist']">Delete</span>
                </button>
              </form>
            </div>
          </div>
        @empty
          <div class="self-stretch p-12 text-center text-neutral-400 font-['Geist'] text-sm">
            No articles in this tab. Click "New Article" to get started!
          </div>
        @endforelse

      </div>

      <!-- Pagination -->
      @if($articles->hasPages())
        <div class="self-stretch pt-4 flex justify-center">
          {{ $articles->links() }}
        </div>
      @endif

    </div>

  </main>

</div>

<!-- Mobile Bottom Navigation Bar (Admin Active) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 h-14 px-8 bg-white border-t border-zinc-300 flex justify-around items-center z-50 shadow-sm">
  <a href="{{ route('home') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
      <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    <span class="text-[10px] font-medium font-['Geist']">Feed</span>
  </a>

  <a href="{{ route('search') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="11" cy="11" r="8"/>
      <path d="m21 21-4.3-4.3"/>
    </svg>
    <span class="text-[10px] font-medium font-['Geist']">Search</span>
  </a>

  <a href="{{ route('articles.create') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <rect width="18" height="18" x="3" y="3" rx="2"/>
      <path d="M12 8v8"/>
      <path d="M8 12h8"/>
    </svg>
    <span class="text-[10px] font-medium font-['Geist']">Create</span>
  </a>

  <a href="{{ route('articles.index') }}" class="inline-flex flex-col justify-center items-center gap-1 text-sky-500">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="12" cy="8" r="5"/>
      <path d="M20 21a8 8 0 0 0-16 0"/>
    </svg>
    <span class="text-[10px] font-bold font-['Geist']">Admin</span>
  </a>
</nav>

</body>
</html>