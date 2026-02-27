<script setup lang="ts">
import {onMounted} from "vue";
import axios from "axios";

const props = defineProps<{
    course: {
        data: {
            id: number;
            title: string;
            subject: string;
            avatar: string;
            content: string;
            views: number;
        }
    }
}>();

onMounted(async () => {
    await axios.get(route('courses.increaseView', {id: props.course.data.id}));
})
</script>

<template>
    <main dir="rtl" class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <article class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Avatar / Cover Image -->
            <div class="relative w-full h-64 sm:h-80 md:h-[450px]">
                <img
                    :src="course.data.avatar"
                    :alt="course.data.title"
                    class="absolute inset-0 w-full h-full object-cover"
                />
            </div>

            <div class="p-6 sm:p-8 md:p-10">
                <!-- Header Information -->
                <header class="mb-8 border-b border-gray-100 pb-8">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                        <!-- Subject Badge -->
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                            {{ course.data.subject }}
                        </span>

                        <!-- Views -->
                        <div
                            class="flex items-center text-gray-600 text-sm font-medium bg-gray-50 px-4 py-2 rounded-full border border-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ course.data.views }} بازدید
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                        {{ course.data.title }}
                    </h1>
                </header>

                <!-- HTML Content -->
                <div
                    class="prose prose-indigo prose-lg sm:prose-xl max-w-none text-gray-700 prose-headings:font-bold prose-headings:text-gray-900 prose-a:text-indigo-600 hover:prose-a:text-indigo-500 prose-img:rounded-2xl leading-loose"
                    v-html="course.data.content"
                ></div>
            </div>
        </article>
    </main>
</template>
