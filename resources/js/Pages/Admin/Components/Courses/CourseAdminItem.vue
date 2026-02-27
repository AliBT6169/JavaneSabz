<script setup lang="ts">
const props = defineProps<{
    course: {
        id: number;
        title: string;
        subject: string;
        avatar: string;
        views: number;
    }
}>();

const emits = defineEmits<{
    (e: 'delete', value: number): void
}>();
</script>

<template>
    <div class="group flex flex-col sm:flex-row items-center justify-between p-4 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 gap-6 w-full" dir="rtl">

        <div class="flex flex-col sm:flex-row items-center gap-5 w-full sm:w-auto">
            <div class="relative w-24 h-24 shrink-0 overflow-hidden rounded-xl shadow-sm border border-gray-100 bg-gray-50">
                <img
                    :src="course.avatar"
                    :alt="course.title"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                />
            </div>

            <div class="flex flex-col items-center sm:items-start gap-2 text-center sm:text-right w-full">
                <h1 class="text-[11px] font-extrabold px-2.5 py-1 bg-indigo-50 text-indigo-600 rounded-md w-max">
                    {{ course.subject }}
                </h1>

                <h2 class="text-lg font-bold text-gray-800 line-clamp-1">
                    {{ course.title }}
                </h2>

                <div class="flex items-center gap-1.5 text-sm text-gray-500 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-gray-400">
                        <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                        <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ course.views.toLocaleString('fa-IR') }} بازدید</span>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-auto flex shrink-0">
            <button
                @click.stop="emits('delete', course.id)"
                class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white rounded-xl transition-all duration-200 font-semibold text-sm focus:ring-4 focus:ring-red-100 outline-none"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                </svg>
                حذف دوره
            </button>
        </div>

    </div>
</template>
