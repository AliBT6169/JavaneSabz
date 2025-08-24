<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    blog: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <Link :href="route('blogs.show',{id:blog.id ,slug:blog.slug})"
          class="w-full relative group space-y-2  rounded-xl overflow-hidden border-4 border-defaultColor5 md:size-60">
        <img :src="blog.icon" alt="" class="size-full">
        <div class="w-full bottom-5 absolute space-y-0.5">
            <div class="px-4 py-1 m-auto w-fit rounded-xl bg-adminColor1/70 dark:bg-adminColor4/60">{{
                    blog.title
                }}
            </div>
            <div class="px-4 py-1 m-auto w-fit rounded-xl bg-adminColor1/70 dark:bg-adminColor4/60">{{
                    'بازدید :' + blog.views
                }}
            </div>
        </div>
    </Link>
</template>
