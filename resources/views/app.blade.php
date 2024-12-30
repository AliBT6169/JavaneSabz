<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{URL('/logo/logo1.png')}}">
        <title class="ml-10">جوانه سبز</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body dir="rtl" class="font-sans antialiased bg-slate-200 w-[90rem] mx-auto">
    @include('icons-svg')
    @inertia
    </body>
    <script setup>
        import { ref } from 'vue';
        import sprite from './path/to/sprite.svg';

        const sprite = ref(sprite);
    </script>
</html>
