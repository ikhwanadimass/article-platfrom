<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings — UNAISOC</title>
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

<!-- Mobile Sticky Top Bar (Mobile Admin Settings v2) -->
<header class="md:hidden sticky top-0 z-40 h-12 px-4 bg-white border-b border-zinc-300 flex justify-between items-center w-full shadow-xs">
  <a href="{{ route('articles.index') }}" class="flex items-center gap-1.5 text-neutral-800 text-sm font-medium font-['Geist'] hover:text-neutral-600 transition">
    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="m15 18-6-6 6-6"/>
    </svg>
    <span>Back</span>
  </a>
  <div class="text-neutral-800 text-base font-extrabold font-['Geist']">Settings</div>
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

        <!-- Admin Profile -->
        <a href="{{ route('articles.index') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="8" r="5"/>
              <path d="M20 21a8 8 0 0 0-16 0"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Admin Profile</div>
        </a>

      </nav>
    </div>

    <!-- Desktop Bottom Actions -->
    <div class="self-stretch flex flex-col justify-start items-start gap-2 pt-6">
      <a href="{{ route('admin.settings') }}" class="self-stretch p-3 bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
        <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
          <svg class="w-4 h-5 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </div>
        <div class="justify-start text-neutral-800 text-base font-bold font-['Geist']">Settings</div>
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

  <!-- Admin Settings Main Area -->
  <main class="flex-1 self-stretch p-4 md:px-14 md:py-10 pb-24 md:pb-12 flex flex-col justify-start items-start gap-6 md:gap-8 overflow-y-auto">
    
    <!-- Page Header (Hidden on Mobile) -->
    <div class="hidden md:flex self-stretch flex-col justify-start items-start gap-1">
      <div class="justify-start text-neutral-800 text-xl font-extrabold font-['Geist']">Admin Settings</div>
      <div class="justify-start text-neutral-500 text-sm font-normal font-['Geist']">Configure your profile settings and manage catalog parameters.</div>
    </div>

    @if(session('success'))
      <div class="self-stretch p-3 md:p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs md:text-sm font-['Geist'] rounded-xl">
        {{ session('success') }}
      </div>
    @endif

    <!-- Mobile Stack Cards (Mobile Admin Settings v2) -->
    <div class="md:hidden self-stretch flex flex-col gap-5">
      
      <!-- Card 1: Edit Profile -->
      <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="self-stretch p-4 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start gap-3.5 shadow-xs">
        @csrf
        @method('PUT')
        <div class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Edit Profile</div>
        
        <!-- Avatar Row -->
        <div class="self-stretch inline-flex justify-between items-center">
          <div class="inline-flex items-center gap-3">
            @if(Auth::user()->avatar)
              <img id="mobileAvatarPreview" class="size-10 rounded-full object-cover outline outline-1 outline-zinc-200" src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" />
            @else
              <div id="mobileAvatarFallback" class="size-10 rounded-full bg-neutral-200 flex justify-center items-center text-neutral-700 font-bold text-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
              </div>
              <img id="mobileAvatarPreview" class="hidden size-10 rounded-full object-cover outline outline-1 outline-zinc-200" src="" alt="" />
            @endif
            <div class="text-neutral-800 text-sm font-medium font-['Geist']">Avatar Graphic</div>
          </div>
          <label class="text-sky-500 hover:text-sky-600 text-sm font-semibold font-['Geist'] cursor-pointer">
            <span>Change</span>
            <input type="file" name="avatar" accept="image/*" class="hidden" onchange="previewMobileAvatar(this)">
          </label>
        </div>

        <div class="self-stretch h-px bg-zinc-200"></div>

        <!-- Display Name -->
        <div class="self-stretch flex flex-col gap-1">
          <label class="text-neutral-500 text-xs font-medium font-['Geist']">Display Name</label>
          <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="self-stretch px-3 py-2 bg-neutral-50 rounded-lg outline outline-1 outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] focus:outline-sky-500">
        </div>

        <!-- Author Bio -->
        <div class="self-stretch flex flex-col gap-1">
          <label class="text-neutral-500 text-xs font-medium font-['Geist']">Author Bio</label>
          <textarea name="bio" class="self-stretch h-20 p-2.5 bg-neutral-50 rounded-lg outline outline-1 outline-zinc-300 text-neutral-800 text-xs font-normal font-['Geist'] resize-none focus:outline-sky-500">{{ old('bio', Auth::user()->bio ?? 'Chief Editor at UNAISOC.') }}</textarea>
        </div>

        <button type="submit" class="self-stretch py-2.5 bg-neutral-800 hover:bg-neutral-900 rounded-lg text-white text-xs font-bold font-['Geist'] transition cursor-pointer text-center">
          Save Changes
        </button>
      </form>

      <!-- Card 2: Manage Categories -->
      <div class="self-stretch p-4 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start gap-3.5 shadow-xs">
        <div class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Manage Categories</div>
        <div class="self-stretch flex flex-col justify-start items-start gap-2.5">
          @forelse($categories as $category)
            <div class="self-stretch inline-flex justify-between items-center py-1">
              <span class="text-neutral-800 text-sm font-medium font-['Geist']">{{ $category->name }}</span>
              <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete category: {{ $category->name }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1 text-neutral-400 hover:text-rose-500 transition cursor-pointer">
                  <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                  </svg>
                </button>
              </form>
            </div>
          @empty
            <div class="text-neutral-400 text-xs">No categories yet.</div>
          @endforelse
        </div>

        <div class="self-stretch h-px bg-zinc-200"></div>

        <!-- Inline Add Category Form -->
        <form action="{{ route('admin.categories.store') }}" method="POST" class="self-stretch flex items-center gap-2">
          @csrf
          <input type="text" name="name" placeholder="New category name..." class="flex-1 px-3 py-1.5 bg-neutral-50 rounded-md outline outline-1 outline-zinc-300 text-xs font-['Geist'] focus:outline-sky-500" required>
          <button type="submit" class="px-3 py-1.5 bg-sky-500 hover:bg-sky-600 rounded-md text-white text-xs font-bold font-['Geist'] shrink-0 transition cursor-pointer">
            + Add
          </button>
        </form>
      </div>

      <!-- Card 3: Security & Logout -->
      <form action="{{ route('logout') }}" method="POST" class="w-full">
        @csrf
        <button type="submit" class="w-full p-3.5 bg-red-100 hover:bg-red-200 rounded-[10px] outline outline-1 outline-offset-[-1px] outline-rose-500 inline-flex justify-center items-center cursor-pointer transition">
          <span class="text-rose-500 text-sm font-bold font-['Geist']">Log Out</span>
        </button>
      </form>

    </div>

    <!-- Desktop Container (Hidden on Mobile) -->
    <div class="hidden md:inline-flex self-stretch bg-white rounded-2xl outline outline-1 outline-offset-[-1px] outline-zinc-300 justify-start items-start overflow-hidden shadow-sm">
      
      <!-- Inner Left Tabs -->
      <div class="w-56 self-stretch border-r border-zinc-300 inline-flex flex-col justify-start items-start shrink-0">
        <button type="button" onclick="switchTab('profile')" id="tabProfile" class="self-stretch p-4 border-l-2 border-neutral-800 inline-flex justify-start items-start text-left w-full transition bg-neutral-50/50">
          <div class="justify-start text-neutral-800 text-sm font-bold font-['Geist']">Edit Profile</div>
        </button>
        <button type="button" onclick="switchTab('categories')" id="tabCategories" class="self-stretch p-4 border-l-2 border-transparent inline-flex justify-start items-start text-left w-full transition hover:bg-neutral-50">
          <div class="justify-start text-neutral-500 text-sm font-medium font-['Geist']">Manage Categories</div>
        </button>
      </div>

      <!-- Inner Right Content -->
      <div class="flex-1 p-8 inline-flex flex-col justify-start items-start gap-8">
        
        <!-- Tab 1: Edit Profile -->
        <div id="contentProfile" class="self-stretch flex flex-col justify-start items-start gap-8">
          <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="self-stretch flex flex-col justify-start items-start gap-6">
            @csrf
            @method('PUT')

            <div class="justify-start text-neutral-800 text-lg font-bold font-['Geist']">Edit Profile</div>
            
            <div class="self-stretch inline-flex justify-start items-center gap-6">
              @if(Auth::user()->avatar)
                <img id="avatarPreview" class="size-16 rounded-[36px] object-cover outline outline-1 outline-zinc-200 shrink-0" src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" />
              @else
                <div id="avatarFallback" class="size-16 rounded-[36px] bg-neutral-200 flex justify-center items-center text-neutral-700 font-bold text-xl overflow-hidden shrink-0">
                  {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <img id="avatarPreview" class="hidden size-16 rounded-[36px] object-cover outline outline-1 outline-zinc-200 shrink-0" src="" alt="" />
              @endif

              <div class="inline-flex flex-col justify-start items-start gap-1.5">
                <div class="justify-start text-neutral-800 text-base font-semibold font-['Geist']">{{ Auth::user()->name }}</div>
                <label class="px-3 py-1.5 bg-sky-500 hover:bg-sky-600 rounded-md inline-flex justify-start items-start text-white text-xs font-bold font-['Geist'] cursor-pointer transition shadow-sm">
                  <span>Upload New Avatar</span>
                  <input type="file" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(this)">
                </label>
              </div>
            </div>

            <div class="self-stretch flex flex-col justify-start items-start gap-4">
              <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
                <label class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Display Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="self-stretch px-3 py-2.5 rounded-md outline outline-1 outline-offset-[-1px] outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] focus:outline-sky-500">
              </div>

              <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
                <label class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Author Bio</label>
                <textarea name="bio" class="self-stretch h-20 p-3 rounded-md outline outline-1 outline-offset-[-1px] outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] resize-none focus:outline-sky-500">{{ old('bio', Auth::user()->bio ?? 'Chief Editor at UNAISOC. Focused on UI architectures, web design systems, and the intersection of visual ergonomics and front-end engineering.') }}</textarea>
              </div>
            </div>

            <button type="submit" class="px-6 py-3 bg-neutral-800 hover:bg-neutral-900 rounded-md inline-flex justify-start items-start text-white text-sm font-bold font-['Geist'] transition cursor-pointer">
              Save Changes
            </button>
          </form>
        </div>

        <!-- Tab 2: Manage Categories -->
        <div id="contentCategories" class="self-stretch flex flex-col justify-start items-start gap-6">
          <div class="self-stretch inline-flex justify-between items-center">
            <div class="justify-start text-neutral-800 text-lg font-bold font-['Geist']">Manage Categories</div>
            <button type="button" onclick="document.getElementById('addCategoryBox').classList.toggle('hidden')" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 rounded-md flex justify-start items-center gap-1.5 text-white text-xs font-bold font-['Geist'] transition cursor-pointer">
              + Add Category
            </button>
          </div>

          <!-- Add category form -->
          <form id="addCategoryBox" action="{{ route('admin.categories.store') }}" method="POST" class="hidden self-stretch flex items-center gap-3 p-4 bg-neutral-50 rounded-lg outline outline-1 outline-zinc-300">
            @csrf
            <input type="text" name="name" placeholder="Category name (e.g. Technology, Culture)..." class="flex-1 px-3 py-2 rounded-md outline outline-1 outline-zinc-300 text-sm font-['Geist'] bg-white focus:outline-sky-500" required>
            <button type="submit" class="px-4 py-2 bg-neutral-800 text-white text-xs font-bold font-['Geist'] rounded-md hover:bg-neutral-900 transition cursor-pointer">Save Category</button>
          </form>

          <!-- Category List -->
          <div class="self-stretch rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start overflow-hidden">
            @forelse($categories as $category)
              <div class="self-stretch p-4 border-b last:border-b-0 border-zinc-300 inline-flex justify-between items-center">
                <div class="flex justify-start items-center gap-3">
                  <div class="justify-start text-neutral-800 text-sm font-semibold font-['Geist']">{{ $category->name }}</div>
                  <div class="justify-start text-neutral-400 text-xs font-normal font-['Geist']">{{ $category->articles_count ?? 0 }} published</div>
                </div>
                <div class="flex justify-start items-start gap-2">
                  <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete category: {{ $category->name }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 rounded-md flex justify-start items-start transition cursor-pointer">
                      <div class="justify-start text-rose-500 text-xs font-semibold font-['Geist']">Delete</div>
                    </button>
                  </form>
                </div>
              </div>
            @empty
              <div class="self-stretch p-6 text-center text-neutral-400 font-['Geist'] text-sm">
                No categories created yet. Click "+ Add Category" to create one.
              </div>
            @endforelse
          </div>
        </div>

        <div class="self-stretch h-px bg-zinc-300"></div>

        <!-- Logout Prompt -->
        <div class="self-stretch inline-flex justify-between items-center">
          <div></div>
          <div class="flex justify-start items-center gap-2">
            <div class="justify-start text-neutral-500 text-sm font-normal font-['Geist']">Ready to leave?</div>
            <form action="{{ route('logout') }}" method="POST" class="inline">
              @csrf
              <button type="submit" class="justify-start text-rose-500 text-sm font-bold font-['Geist'] hover:underline cursor-pointer">Log Out</button>
            </form>
          </div>
        </div>

      </div>

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
    <span class="text-[10px] font-medium font-['Geist']">Home</span>
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

<script>
  function switchTab(tab) {
    const tabProfile = document.getElementById('tabProfile');
    const tabCategories = document.getElementById('tabCategories');
    const contentProfile = document.getElementById('contentProfile');
    const contentCategories = document.getElementById('contentCategories');

    if (tab === 'profile') {
      tabProfile.className = "self-stretch p-4 border-l-2 border-neutral-800 inline-flex justify-start items-start text-left w-full transition bg-neutral-50/50";
      tabProfile.firstElementChild.className = "justify-start text-neutral-800 text-sm font-bold font-['Geist']";
      tabCategories.className = "self-stretch p-4 border-l-2 border-transparent inline-flex justify-start items-start text-left w-full transition hover:bg-neutral-50";
      tabCategories.firstElementChild.className = "justify-start text-neutral-500 text-sm font-medium font-['Geist']";
      contentProfile.scrollIntoView({ behavior: 'smooth' });
    } else {
      tabCategories.className = "self-stretch p-4 border-l-2 border-neutral-800 inline-flex justify-start items-start text-left w-full transition bg-neutral-50/50";
      tabCategories.firstElementChild.className = "justify-start text-neutral-800 text-sm font-bold font-['Geist']";
      tabProfile.className = "self-stretch p-4 border-l-2 border-transparent inline-flex justify-start items-start text-left w-full transition hover:bg-neutral-50";
      tabProfile.firstElementChild.className = "justify-start text-neutral-500 text-sm font-medium font-['Geist']";
      contentCategories.scrollIntoView({ behavior: 'smooth' });
    }
  }

  function previewAvatar(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('avatarPreview');
        const fallback = document.getElementById('avatarFallback');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        if (fallback) fallback.classList.add('hidden');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function previewMobileAvatar(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('mobileAvatarPreview');
        const fallback = document.getElementById('mobileAvatarFallback');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        if (fallback) fallback.classList.add('hidden');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

</body>
</html>
