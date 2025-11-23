<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;600;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-slate-900 text-white overflow-hidden selection:bg-emerald-500 selection:text-white">

<div class="relative min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">

    <div class="absolute inset-0 overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50rem] h-[50rem] bg-emerald-600/30 rounded-full blur-3xl mix-blend-screen animate-pulse"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[50rem] h-[50rem] bg-teal-600/20 rounded-full blur-3xl mix-blend-screen"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/50 via-slate-900/20 to-slate-900/80"></div>
    </div>

    <div class="w-full max-w-4xl flex flex-col items-center space-y-12 z-10">

        <div class="text-center">
            <h1 class="text-7xl md:text-9xl font-extrabold tracking-tighter text-transparent bg-clip-text bg-gradient-to-br from-white via-emerald-100 to-teal-200 drop-shadow-2xl">
                Welcome
            </h1>
            <p class="mt-4 text-lg md:text-xl text-emerald-200/60 font-light tracking-widest uppercase">
                To Your New Space
            </p>
        </div>

        <div class="w-full bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden transition-transform hover:scale-[1.01] duration-500 ease-out">

            <div class="w-full h-[650px] bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-y-auto">
                <iframe
                    src="{{ route('widget.show') }}"
                    class="w-full h-full border-none"
                ></iframe>
            </div>
        </div>

    </div>
</div>

</body>
</html>
