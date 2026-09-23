<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article — UNAISOC</title>
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

<!-- Mobile Sticky Top Bar (Mobile Edit Article) -->
<header class="md:hidden sticky top-0 z-40 h-12 px-4 bg-white border-b border-zinc-300 flex justify-between items-center w-full shadow-xs">
  <a href="{{ route('articles.index') }}" class="flex items-center gap-1 text-neutral-800 text-sm font-medium font-['Geist'] hover:text-neutral-600 transition">
    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <path d="m15 18-6-6 6-6"/>
    </svg>
    <span>Back</span>
  </a>
  <div class="text-neutral-800 text-base font-extrabold font-['Geist']">Edit Article</div>
  <button type="button" onclick="submitMobileEditForm('publish')" class="px-3 py-1.5 bg-sky-500 hover:bg-sky-600 rounded-md text-white text-xs font-bold font-['Geist'] shadow-xs cursor-pointer">
    Update
  </button>
</header>

<!-- Mobile Form Container (md:hidden) -->
<div class="md:hidden w-full min-h-screen bg-neutral-50 flex flex-col justify-start items-start pb-24">
  <form id="mobileEditForm" action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="w-full p-4 flex flex-col justify-start items-start gap-5">
    @csrf
    @method('PUT')
    <input type="hidden" id="mobileEditAction" name="action" value="publish">

    @if(isset($errors) && $errors->any())
      <div class="self-stretch p-3 bg-red-50 text-rose-600 text-xs font-['Geist'] rounded-lg">
        {{ $errors->first() }}
      </div>
    @endif

    <!-- Upload Hero Cover Image Box -->
    <label class="self-stretch p-6 bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-sky-500 flex flex-col justify-center items-center gap-3 cursor-pointer hover:bg-sky-50/20 transition relative overflow-hidden">
      @if($article->thumbnail)
        <img id="mobileImgPreview" class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/' . $article->thumbnail) }}" alt="" />
      @else
        <img id="mobileImgPreview" class="hidden absolute inset-0 w-full h-full object-cover" src="" alt="" />
      @endif

      <div class="relative z-10 bg-white/90 backdrop-blur-xs p-3 rounded-xl flex flex-col items-center gap-1 shadow-xs">
        <div class="text-neutral-800 text-xs font-bold font-['Geist']">Update cover image</div>
        <div class="text-neutral-500 text-[10px] font-normal font-['Geist']">Tap to replace current photo</div>
      </div>
      <input type="file" name="thumbnail" accept="image/*" class="hidden" onchange="previewMobileEditFile(this)">
    </label>

    <!-- Article Title -->
    <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
      <label class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Article Title</label>
      <input type="text" name="title" value="{{ old('title', $article->title) }}" required class="self-stretch px-3.5 py-3 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] focus:outline-sky-500">
    </div>

    <!-- Category -->
    <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
      <label class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Category</label>
      <select name="category_id" required class="self-stretch px-3.5 py-3 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] focus:outline-sky-500">
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    <!-- Author (Disabled/Display) -->
    <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
      <div class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Author</div>
      <div class="self-stretch px-3.5 py-2.5 bg-neutral-100 rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 inline-flex justify-start items-center gap-3">
        @if($article->author?->avatar)
          <img class="size-6 rounded-full object-cover shrink-0" src="{{ asset('storage/' . $article->author->avatar) }}" alt="" />
        @else
          <div class="size-6 rounded-full bg-neutral-300 flex items-center justify-center text-[10px] font-bold text-neutral-700">
            {{ strtoupper(substr($article->author->name ?? Auth::user()->name, 0, 1)) }}
          </div>
        @endif
        <div class="flex-1 text-neutral-800 text-sm font-semibold font-['Geist']">{{ $article->author->name ?? Auth::user()->name }}</div>
        <div class="px-1.5 py-0.5 bg-white rounded-sm outline outline-1 outline-zinc-300 flex justify-start items-start">
          <div class="text-sky-500 text-[9px] font-bold font-['Geist']">Chief Editor</div>
        </div>
      </div>
    </div>

    <!-- Publication Date -->
    <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
      <div class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Publication Date</div>
      <div class="self-stretch px-3.5 py-3 bg-white rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 inline-flex justify-between items-center text-neutral-800 text-sm font-normal font-['Geist']">
        <span>{{ $article->created_at->format('M d, Y') }}</span>
        <svg class="size-4 text-neutral-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
          <line x1="16" y1="2" x2="16" y2="6"/>
          <line x1="8" y1="2" x2="8" y2="6"/>
          <line x1="3" y1="10" x2="21" y2="10"/>
        </svg>
      </div>
    </div>

    <!-- Article Body with Formatting Toolbar -->
    <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
      <div class="text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Article Content</div>
      <div class="self-stretch bg-white rounded-xl outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start overflow-hidden">
        <div class="self-stretch px-3 py-2 bg-neutral-100 border-b border-zinc-300 inline-flex justify-start items-center gap-3 text-neutral-600">
          <button type="button" onclick="formatMobileEditDoc('bold')" class="font-bold text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Bold">B</button>
          <button type="button" onclick="formatMobileEditDoc('italic')" class="italic text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Italic">I</button>
          <button type="button" onclick="formatMobileEditDoc('underline')" class="underline text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Underline">U</button>
          <div class="w-px h-3.5 bg-zinc-300"></div>
          <button type="button" onclick="formatMobileEditDoc('insertUnorderedList')" class="text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Bullet List">• List</button>
          <button type="button" onclick="addMobileEditLink()" class="text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Insert Link">🔗 Link</button>
        </div>
        <div id="mobileEditContentEditor" contenteditable="true" class="self-stretch min-h-[140px] p-4 text-neutral-800 text-sm font-normal font-['Geist'] leading-5 outline-none">{!! old('content', $article->content) !!}</div>
        <textarea id="mobileEditHiddenContent" name="content" class="hidden" required>{{ old('content', $article->content) }}</textarea>
      </div>
    </div>

    <!-- Bottom Actions -->
    <div class="self-stretch flex flex-col gap-2 pt-2">
      <button type="button" onclick="submitMobileEditForm('publish')" class="self-stretch p-3.5 bg-sky-500 hover:bg-sky-600 rounded-lg text-white text-base font-bold font-['Geist'] text-center cursor-pointer transition shadow-sm">
        Update & Publish
      </button>
      
      <button type="button" onclick="submitMobileEditForm('draft')" class="self-stretch py-2 text-neutral-500 hover:text-neutral-800 text-xs font-semibold font-['Geist'] text-center cursor-pointer transition">
        {{ $article->status === 'draft' ? 'Saved as Draft' : 'Save as Draft' }}
      </button>
    </div>

  </form>
</div>

<!-- Desktop Container (Hidden on mobile, exact desktop modal) -->
<div class="hidden md:flex w-full min-h-screen bg-neutral-50 justify-start items-start">
  
  <!-- Desktop Sidebar -->
  <aside class="w-60 min-h-screen self-stretch px-6 pt-10 pb-6 bg-white border-r border-zinc-300 flex flex-col justify-between items-start shrink-0 sticky top-0 h-screen overflow-y-auto">
    <div class="self-stretch flex flex-col justify-start items-start gap-9">
      
      <div class="pl-2 inline-flex justify-start items-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 hover:opacity-90 transition">
          <img class="size-8 object-contain" src="{{ asset('UNAISOC_LOGO.png') }}" alt="UNAISOC" />
          <span class="justify-start text-neutral-800 text-xl font-extrabold font-['Geist'] tracking-tight">
            UNAISOC
          </span>
        </a>
      </div>

      <nav class="self-stretch flex flex-col justify-start items-start gap-2">
        <a href="{{ route('home') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
              <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Home</div>
        </a>

        <a href="{{ route('search') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.3-4.3"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Search</div>
        </a>

        <a href="{{ route('articles.create') }}" class="self-stretch p-3 bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-sky-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect width="18" height="18" x="3" y="3" rx="2"/>
              <path d="M12 8v8"/>
              <path d="M8 12h8"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-800 text-base font-bold font-['Geist']">Edit Article</div>
        </a>

        <a href="{{ route('articles.index') }}" class="self-stretch p-3 bg-black/0 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
          <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
            <svg class="w-4 h-4 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="8" r="5"/>
              <path d="M20 21a8 8 0 0 0-16 0"/>
            </svg>
          </div>
          <div class="justify-start text-neutral-500 text-base font-medium font-['Geist']">Admin Profile</div>
        </a>
      </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="self-stretch flex flex-col justify-start items-start gap-2 pt-6">
      <a href="{{ route('admin.settings') }}" class="self-stretch p-3 hover:bg-neutral-100 rounded-lg inline-flex justify-start items-center gap-4 transition">
        <div class="size-5 inline-flex flex-col justify-center items-center overflow-hidden">
          <svg class="w-4 h-5 text-neutral-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
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

  <!-- Modal Center Container -->
  <main class="flex-1 self-stretch bg-neutral-900/40 min-h-screen inline-flex flex-col justify-center items-center py-10 px-4 overflow-y-auto">
    <div class="w-[840px] max-w-full bg-white rounded-2xl shadow-[0px_12px_32px_0px_rgba(0,0,0,0.10)] flex flex-col justify-start items-start overflow-hidden">
      
      <!-- Modal Header -->
      <div class="self-stretch px-6 py-4 border-b border-zinc-300 inline-flex justify-between items-center">
        <div class="justify-start text-neutral-800 text-base font-bold font-['Geist']">Edit Article</div>
        <a href="{{ route('articles.index') }}" class="size-6 flex justify-center items-center text-neutral-500 hover:text-neutral-800 transition">
          <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6 6 18M6 6l12 12"/>
          </svg>
        </a>
      </div>

      <!-- Desktop Modal Body Form -->
      <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="self-stretch flex-1 flex flex-row justify-start items-start">
        @csrf
        @method('PUT')

        <!-- Left Image Area -->
        <div class="w-96 self-stretch p-8 bg-neutral-100 border-r border-zinc-300 flex flex-col justify-center items-center gap-4 relative shrink-0">
          @if($article->thumbnail)
            <img id="imgPreview" class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/' . $article->thumbnail) }}" alt="" />
          @else
            <img id="imgPreview" class="hidden absolute inset-0 w-full h-full object-cover" src="" alt="" />
          @endif

          <div class="relative z-10 bg-white/80 backdrop-blur-sm p-4 rounded-xl flex flex-col items-center gap-2 text-center shadow-sm">
            <div class="text-xs font-semibold text-neutral-700 font-['Geist']">Update Cover Image</div>
            <label class="px-4 py-2 bg-sky-500 hover:bg-sky-600 rounded-md inline-flex justify-start items-start text-white text-xs font-bold font-['Geist'] cursor-pointer transition shadow-sm">
              <span>Change Image</span>
              <input type="file" name="thumbnail" accept="image/*" class="hidden" onchange="previewFile(this)">
            </label>
          </div>
        </div>

        <!-- Right Inputs Area -->
        <div class="flex-1 self-stretch p-6 flex flex-col justify-between items-start gap-4">
          <div class="self-stretch flex flex-col justify-start items-start gap-3.5">
            
            <!-- Article Title -->
            <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
              <label class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Article Title</label>
              <input type="text" name="title" value="{{ old('title', $article->title) }}" required class="self-stretch px-3 py-2.5 rounded-md outline outline-1 outline-offset-[-1px] outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] focus:outline-sky-500">
            </div>

            <!-- Category & Author Row -->
            <div class="self-stretch inline-flex justify-start items-start gap-4">
              <div class="flex-1 inline-flex flex-col justify-start items-start gap-1.5">
                <label class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Category</label>
                <select name="category_id" required class="self-stretch px-3 py-2.5 rounded-md outline outline-1 outline-offset-[-1px] outline-zinc-300 text-neutral-800 text-sm font-normal font-['Geist'] bg-white focus:outline-sky-500">
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                      {{ $category->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="flex-1 inline-flex flex-col justify-start items-start gap-1.5">
                <label class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Author</label>
                <input type="text" value="{{ $article->author->name ?? Auth::user()->name }}" disabled class="self-stretch px-3 py-2.5 rounded-md outline outline-1 outline-offset-[-1px] outline-zinc-300 bg-neutral-50 text-neutral-800 text-sm font-normal font-['Geist']">
              </div>
            </div>

            <!-- Content Area with interactive formatting toolbar -->
            <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
              <label class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase">Article Content</label>
              <div class="self-stretch rounded-md outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-start overflow-hidden">
                <div class="self-stretch px-3 py-1.5 bg-neutral-100 border-b border-zinc-300 inline-flex justify-start items-center gap-2 text-neutral-600">
                  <button type="button" onclick="formatDoc('bold')" class="font-bold text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Bold">B</button>
                  <button type="button" onclick="formatDoc('italic')" class="italic text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Italic">I</button>
                  <button type="button" onclick="formatDoc('underline')" class="underline text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Underline">U</button>
                  <button type="button" onclick="formatDoc('insertUnorderedList')" class="text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Bullet List">• List</button>
                  <button type="button" onclick="addLink()" class="text-xs hover:text-neutral-900 px-2 py-0.5 rounded hover:bg-neutral-200 transition" title="Insert Link">🔗 Link</button>
                </div>
                <div id="contentEditor" contenteditable="true" class="self-stretch min-h-[140px] max-h-[220px] p-3 text-neutral-800 text-sm font-normal font-['Geist'] outline-none overflow-y-auto focus:bg-neutral-50/30">{!! old('content', $article->content) !!}</div>
                <textarea id="hiddenContent" name="content" class="hidden" required>{{ old('content', $article->content) }}</textarea>
              </div>
            </div>

          </div>

          <!-- Footer Actions -->
          <div class="self-stretch inline-flex justify-between items-center pt-2">
            <button type="submit" name="action" value="draft" onclick="syncContent()" class="px-3 py-1.5 rounded-md hover:bg-neutral-100 text-neutral-500 hover:text-neutral-800 text-xs font-semibold font-['Geist'] transition cursor-pointer flex items-center gap-1.5">
              <svg class="size-3.5 text-neutral-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
              </svg>
              <span>{{ $article->status === 'draft' ? 'Saved as Draft' : 'Save as Draft' }}</span>
            </button>

            <button type="submit" name="action" value="publish" onclick="syncContent()" class="px-6 py-2.5 bg-sky-500 hover:bg-sky-600 rounded-md flex justify-start items-start text-white text-sm font-bold font-['Geist'] transition cursor-pointer shadow-sm">
              Update & Publish
            </button>
          </div>
        </div>

      </form>

    </div>
  </main>

</div>

<!-- Mobile Bottom Navigation Bar (Create Active) -->
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

  <a href="{{ route('articles.create') }}" class="inline-flex flex-col justify-center items-center gap-1 text-sky-500">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <rect width="18" height="18" x="3" y="3" rx="2"/>
      <path d="M12 8v8"/>
      <path d="M8 12h8"/>
    </svg>
    <span class="text-[10px] font-bold font-['Geist']">Create</span>
  </a>

  <a href="{{ route('articles.index') }}" class="inline-flex flex-col justify-center items-center gap-1 text-neutral-500 hover:text-neutral-800">
    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      <circle cx="12" cy="8" r="5"/>
      <path d="M20 21a8 8 0 0 0-16 0"/>
    </svg>
    <span class="text-[10px] font-medium font-['Geist']">Admin</span>
  </a>
</nav>

<script>
  function formatDoc(command) {
    document.execCommand(command, false, null);
    document.getElementById('contentEditor').focus();
    syncContent();
  }

  function addLink() {
    const url = prompt('Enter URL (e.g. https://example.com):');
    if (url) {
      document.execCommand('createLink', false, url);
      document.getElementById('contentEditor').focus();
      syncContent();
    }
  }

  function syncContent() {
    const editor = document.getElementById('contentEditor');
    const textarea = document.getElementById('hiddenContent');
    textarea.value = editor.innerHTML.trim();
  }

  if (document.getElementById('contentEditor')) {
    document.getElementById('contentEditor').addEventListener('input', syncContent);
  }

  function previewFile(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('imgPreview');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  /* Mobile Editor Functions */
  function formatMobileEditDoc(command) {
    document.execCommand(command, false, null);
    document.getElementById('mobileEditContentEditor').focus();
    syncMobileEditContent();
  }

  function addMobileEditLink() {
    const url = prompt('Enter URL (e.g. https://example.com):');
    if (url) {
      document.execCommand('createLink', false, url);
      document.getElementById('mobileEditContentEditor').focus();
      syncMobileEditContent();
    }
  }

  function syncMobileEditContent() {
    const editor = document.getElementById('mobileEditContentEditor');
    const textarea = document.getElementById('mobileEditHiddenContent');
    textarea.value = editor.innerHTML.trim();
  }

  if (document.getElementById('mobileEditContentEditor')) {
    document.getElementById('mobileEditContentEditor').addEventListener('input', syncMobileEditContent);
  }

  function previewMobileEditFile(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const preview = document.getElementById('mobileImgPreview');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  function submitMobileEditForm(action) {
    syncMobileEditContent();
    document.getElementById('mobileEditAction').value = action;
    document.getElementById('mobileEditForm').submit();
  }
</script>

</body>
</html>