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
          class="w-full space-y-2  rounded-xl overflow-hidden border-4 bg-gray-300 border-defaultColor5 md:w-80">
        <img :src="blog.icon" alt="" class="w-full md:size-80 ">
        <h2 class="text-center text-2xl">{{
                blog.title
            }}
        </h2>
        <div class="border-t w-full p-2 flex text-xs justify-between">
            <div class="">{{
                    'تاریخ :' + blog.created_at
                }}
            </div>
            <div class="">{{
                    'بازدید :' + blog.views
                }}
            </div>
        </div>
    </Link>
</template>
