<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNAISOC</title>
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
<body class="bg-neutral-50 text-neutral-800 antialiased selection:bg-neutral-200 selection:text-neutral-800">

<!-- Mobile Top Header (Mobile Guest / Admin Feed) -->
<header class="md:hidden sticky top-0 z-40 h-12 px-4 bg-white border-b border-zinc-300 flex justify-between items-center w-full">
  <a href="{{ route('home') }}" class="inline-flex items-center gap-2">
    <img class="size-7 object-contain" src="{{ asset('UNAISOC_LOGO.png') }}" alt="UNAISOC" />
    <span class="text-neutral-800 text-lg font-extrabold font-['Geist'] tracking-tight">UNAISOC</span>
  </a>
  @guest
    <a href="{{ route('login') }}" class="px-3 py-1.5 text-sky-500 text-sm font-semibold font-['Geist'] hover:text-sky-600 transition">Admin Login</a>
  @else
    <a href="{{ route('admin.settings') }}" class="text-neutral-600 hover:text-neutral-900 text-xs font-semibold font-['Geist'] px-2 py-1">Settings</a>
  @endguest
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

  <!-- Main Feed Area -->
  <main class="flex-1 self-stretch w-full py-5 md:py-10 px-4 md:px-0 pb-24 md:pb-12 inline-flex flex-col justify-start items-center overflow-y-auto">
    <div class="w-full max-w-[640px] flex flex-col justify-start items-start gap-5 md:gap-6">

      @guest
        <!-- Welcome to UNAISOC banner -->
        <div class="self-stretch p-4 md:p-5 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start gap-2 shadow-sm">
          <div class="justify-start text-neutral-800 text-sm md:text-base font-bold font-['Geist']">Welcome to UNAISOC</div>
          <div class="self-stretch justify-start text-neutral-500 text-xs font-normal font-['Geist'] leading-5">Exploring perspectives in tech and design. Log in to the administrator portal using the sidebar button to write or manage articles.</div>
        </div>
      @endguest

      <!-- Articles Feed -->
      <div class="self-stretch flex flex-col justify-start items-start gap-4 md:gap-6">
        @forelse($articles as $article)
          <article class="self-stretch bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start overflow-hidden shadow-sm hover:shadow-md transition">
            
            <!-- Article Image -->
            <a href="{{ route('blog.show', $article->slug) }}" class="self-stretch block overflow-hidden bg-neutral-100">
              @if($article->thumbnail)
                <img class="self-stretch w-full h-48 md:h-80 object-cover hover:scale-[1.01] transition duration-300" src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" />
              @else
                <div class="self-stretch w-full h-48 md:h-80 bg-neutral-100 flex flex-col items-center justify-center text-neutral-400 gap-2">
                  <svg class="size-8 md:size-10 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect width="18" height="18" x="3" y="3" rx="2"/>
                    <circle cx="9" cy="9" r="2"/>
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                  </svg>
                  <span class="text-[11px] md:text-xs font-['Geist'] font-medium text-neutral-400">UNAISOC Publication</span>
                </div>
              @endif
            </a>

            <!-- Article Content Card -->
            <div class="self-stretch p-4 md:p-6 flex flex-col justify-start items-start gap-2.5 md:gap-3">
              
              <!-- Author & Category Meta -->
              <div class="self-stretch inline-flex justify-between items-center">
                <!-- Author Info -->
                <div class="flex justify-start items-center gap-1.5 md:gap-2">
                  @if($article->author?->avatar)
                    <img class="size-4 md:size-6 rounded-full object-cover shrink-0" src="{{ $article->author->avatar_url }}" alt="" />
                  @else
                    <div class="size-4 md:size-6 rounded-full bg-neutral-200 flex justify-center items-center overflow-hidden shrink-0 text-neutral-700 font-bold text-[8px] md:text-[10px]">
                      {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
                    </div>
                  @endif
                  @if($article->author)
                    <a href="{{ route('author.show', $article->author->id) }}" class="justify-start text-neutral-800 text-xs font-semibold font-['Geist'] hover:text-sky-600 transition">
                      {{ $article->author->name }}
                    </a>
                  @else
                    <div class="justify-start text-neutral-800 text-xs font-semibold font-['Geist']">
                      Marcus Sterling
                    </div>
                  @endif
                </div>

                <!-- Category & Date Tag -->
                <div class="flex justify-start items-center gap-1.5 md:gap-2">
                  <div class="px-1.5 py-0.5 md:px-2 md:py-1 bg-neutral-100 rounded-sm flex justify-start items-start">
                    <div class="justify-start text-neutral-500 text-[9px] md:text-xs font-bold font-['Geist'] uppercase tracking-wider">
                      {{ $article->category->name ?? 'General' }}
                    </div>
                  </div>
                  <div class="size-[3px] bg-neutral-400 rounded-full"></div>
                  <div class="justify-start text-neutral-400 text-xs font-normal font-['Geist']">
                    {{ $article->created_at->format('M d') }}
                  </div>
                </div>
              </div>

              <!-- Article Title -->
              <a href="{{ route('blog.show', $article->slug) }}" class="self-stretch justify-start text-neutral-800 text-base md:text-lg font-bold font-['Geist'] leading-5 md:leading-6 hover:text-sky-600 transition">
                {{ $article->title }}
              </a>

              <!-- Article Excerpt -->
              <div class="self-stretch justify-start text-neutral-500 text-xs md:text-sm font-normal font-['Geist'] leading-5 line-clamp-2">
                {{ Str::limit(strip_tags($article->content), 180) }}
              </div>

              <!-- Read Full Article CTA -->
              <div class="pt-1 md:pt-2 inline-flex justify-start items-start">
                <a href="{{ route('blog.show', $article->slug) }}" class="justify-start text-sky-500 text-xs md:text-sm font-semibold font-['Geist'] hover:underline">
                  Read Full Article →
                </a>
              </div>

            </div>
          </article>
        @empty
          <div class="self-stretch bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 p-8 md:p-12 text-center flex flex-col items-center justify-center gap-3">
            <svg class="size-8 md:size-10 text-neutral-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.3-4.3"/>
            </svg>
            <div class="text-neutral-700 text-sm md:text-base font-semibold font-['Geist']">No articles found</div>
            <div class="text-neutral-400 text-xs md:text-sm font-['Geist']">There are no publications published yet.</div>
          </div>
        @endforelse

        <!-- Pagination -->
        @if($articles->hasPages())
          <div class="self-stretch pt-4 flex justify-center items-center">
            {{ $articles->links() }}
          </div>
        @endif

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