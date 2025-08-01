<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{URL('/logo/logo.png')}}">
    <title class="ml-10">جوانه سبز</title>
    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body dir="rtl" class="font-sans antialiased bg-slate-200 dark:bg-slate-800 duration-300 dark:text-white">
{{--<div id="loader" class="bg-gradient-to-r from-blue-200 to-red-200 size-40 fixed z-50 top-[calc(50vh-5rem)] left-[calc(50vw-5rem)] flex justify-center duration-500 items-center rounded-full animate-spin shadow-lg shadow-black/50--}}
{{--                    before:absolute before:size-full before:rounded-full before:border-l-[16px] before:border-t-[16px] before:border-defaultColor/60--}}
{{--                    after:absolute after:size-full after:rounded-full after:border-r-[16px] after:border-b-[16px] after:border-defaultColor5/60 "></div>--}}
<div style="display: none;">
    @include('icons-svg')
</div>
@inertia
</body>
<script setup>
    import {ref} from 'vue';
    import sprite from './path/to/sprite.svg';

    const sprite = ref(sprite);
</script>
</html>
