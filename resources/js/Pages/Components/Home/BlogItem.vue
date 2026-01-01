<script setup>
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    blog: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <Link :href="route('blogs.show',{id:blog.id, slug:blog.slug})"
          class="group relative flex flex-col w-full md:w-80 bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">

        <!-- Image Container with Overlay Effect -->
        <div class="relative h-56 w-full overflow-hidden">
            <img :src="blog.icon"
                 :alt="blog.title"
                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>

        <!-- Content Section -->
        <div class="flex flex-col flex-grow p-5">
            <!-- Title -->
            <h2 class="text-gray-800 font-bold text-xl leading-tight mb-3 line-clamp-2 group-hover:text-defaultColor5 transition-colors">
                {{ blog.title }}
            </h2>

            <!-- Spacer to push footer down -->
            <div class="flex-grow"></div>

            <!-- Meta Data (Footer) -->
            <div class="flex items-center justify-between text-gray-500 text-xs mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ blog.created_at }}</span>
                </div>

                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>{{ blog.views }}</span>
                </div>
            </div>
        </div>
    </Link>
</template>
