<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNAISOC — Admin Portal</title>
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
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus {
            -webkit-text-fill-color: #262626;
            -webkit-box-shadow: 0 0 0px 1000px #FAFAFA inset;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body class="bg-neutral-50 text-neutral-800 antialiased selection:bg-neutral-200 selection:text-neutral-800">

<div class="w-full min-h-screen bg-neutral-50 flex flex-col justify-center items-center gap-6 py-8 px-4">
  
  <div class="w-full max-w-sm p-6 md:p-10 bg-white rounded-xl shadow-xs outline outline-1 outline-offset-[-1px] outline-zinc-300 flex flex-col justify-start items-center gap-8">
    
    <!-- Header -->
    <div class="flex flex-col justify-start items-center gap-3">
      <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 hover:opacity-95 transition">
        <img class="size-16 object-contain" src="{{ asset('UNAISOC_LOGO.png') }}" alt="UNAISOC" />
        <span class="justify-start text-neutral-800 text-3xl md:text-4xl font-extrabold font-['Geist'] tracking-tight">UNAISOC</span>
      </a>
      <div class="justify-start text-neutral-500 text-xs md:text-sm font-semibold font-['Geist'] uppercase tracking-wider">Admin Portal</div>
    </div>

    @if (isset($errors) && $errors->any())
      <div class="self-stretch p-3 rounded-lg bg-red-50 border border-red-200 text-rose-600 text-xs font-['Geist']">
        {{ $errors->first() }}
      </div>
    @endif

    <!-- Form -->
    <form action="/login" method="POST" class="self-stretch flex flex-col justify-start items-start gap-4">
      @csrf

      <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
        <label for="email" class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase tracking-wider">Email or Username</label>
        <div class="self-stretch px-3.5 py-3 bg-neutral-50 rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 flex items-center focus-within:outline-neutral-800 focus-within:bg-white transition">
          <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="admin@unaisoc.com" class="flex-1 bg-transparent border-none outline-none text-neutral-800 text-sm font-normal font-['Geist'] placeholder-neutral-400">
        </div>
      </div>

      <div class="self-stretch flex flex-col justify-start items-start gap-1.5">
        <label for="password" class="justify-start text-neutral-500 text-xs font-bold font-['Geist'] uppercase tracking-wider">Password</label>
        <div class="self-stretch px-3.5 py-3 bg-neutral-50 rounded-lg outline outline-1 outline-offset-[-1px] outline-zinc-300 flex items-center focus-within:outline-neutral-800 focus-within:bg-white transition">
          <input type="password" id="password" name="password" required placeholder="••••••••••••" class="flex-1 bg-transparent border-none outline-none text-neutral-800 text-sm font-normal font-['Geist'] placeholder-neutral-400">
        </div>
      </div>

      <div class="self-stretch inline-flex justify-start items-center gap-2.5">
        <label class="inline-flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="remember" class="size-4 text-neutral-800 rounded-sm border-zinc-300 focus:ring-neutral-800">
          <span class="justify-start text-neutral-500 text-xs font-medium font-['Geist']">Remember me</span>
        </label>
      </div>

      <button type="submit" class="self-stretch p-3.5 bg-sky-500 hover:bg-sky-600 rounded-lg inline-flex justify-center items-center transition cursor-pointer mt-2 shadow-xs">
        <span class="text-white text-sm font-bold font-['Geist']">Sign In as Admin</span>
      </button>
    </form>

    <a href="{{ route('home') }}" class="justify-start text-neutral-500 text-sm font-semibold font-['Geist'] underline hover:text-neutral-800 transition">
      Return to Public Articles
    </a>

  </div>

</div>

</body>
</html>