<script setup>
import IndexLyout from "@/Pages/IndexLyout.vue";
import { onMounted, ref } from "vue";

const props = defineProps({
    blog: Object,
});

const content = ref(null);

onMounted(() => {
    if (content.value && props.blog.data.description) {
        content.value.innerHTML = props.blog.data.description;
    }
});
</script>

<template>
    <IndexLyout>
        <div class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <!-- Header Section with Overlay Image -->
            <div class="relative w-full h-[400px] rounded-3xl overflow-hidden shadow-2xl mb-10 group">
                <img
                    :src="blog.data.icon"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    :alt="blog.data.title"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8 text-center sm:text-right">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white drop-shadow-md leading-tight mb-4">
                        {{ blog.data.title }}
                    </h1>
                    <div class="flex flex-wrap justify-center sm:justify-end items-center gap-4 text-gray-300 text-sm font-medium">
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <span>{{ blog.data.created_at }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ blog.data.views }} بازدید</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <article class="prose prose-lg prose-slate dark:prose-invert max-w-none mx-auto bg-white dark:bg-gray-800 p-8 md:p-12 rounded-3xl shadow-lg border border-gray-100 dark:border-gray-700">
                <div ref="content" class="leading-relaxed text-justify"></div>
            </article>

            <!-- Footer / Share Section (Optional Placeholder) -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-center text-gray-500">
                <p class="text-sm">پایان مقاله</p>
            </div>
        </div>
    </IndexLyout>
</template>

<style>
/* Custom prose styling for better typography in the content block */
.prose img {
    border-radius: 1rem;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
}
.prose h2, .prose h3 {
    color: inherit;
    font-weight: 700;
}
</style>
