<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 12 Task List App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    {{--  blade-formatter-disable }}
     <style>
         label {
             @apply block uppercase text-slate-800 mb-2
         }

         input, textarea {
             @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:shadow-outline
         }
         .error{
            @apply text-red-500 text-sm
         }
     </style>

     {{-- blade-formatter-enable --}}
    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-10 max-w-lg ">
<h1 class="text-3xl font-bold mb-5">
    @yield('title')
</h1>
<div>
    @if(session()->has('success'))
        <div> {{session('success')}} </div>
    @endif
    @yield('content')
</div>
</body>
</html>
