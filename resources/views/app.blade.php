<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{URL('/logo/logo1.png')}}">
        <title class="ml-10">جوانه سبز</title>
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body dir="rtl" class="font-sans antialiased bg-slate-200 dark:bg-slate-800 w-screen mx-auto">
    @include('icons-svg')
    @inertia
    </body>
    <script setup>
        import { ref } from 'vue';
        import sprite from './path/to/sprite.svg';

        const sprite = ref(sprite);
    </script>
</html>
