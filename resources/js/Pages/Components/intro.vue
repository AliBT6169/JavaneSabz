<script setup>

import SvgComponent from "@/Components/svg-component.vue";
import {onMounted, ref} from "vue";

const intro_view = ref(true);
const intro_animation = ref(false);
onMounted(() => {
    setTimeout(() => {
        intro_animation.value = true;
    }, 1600)
    setTimeout(() => {
        intro_view.value = false;
    }, 3000);
});

</script>

<template>
    <div id="intro"
         class="top-0 left-0 bg-slate-800 bg-opacity-80 z-50 w-screen h-full absolute flex items-center duration-1000 ease-in justify-center"
         :class="{'!top-[-5000px]':!intro_view ,'top-[40px]':intro_animation}">
        <div class="flex items-center gap-2 justify-center text-white">
            <img src="../../../../public/logo/logo1.png" class="size-52" alt="">
            <div class="w-2 h-24 bg-white rounded-full"></div>
            <div class="flex gap-2 flex-col">
                <div class="font-[1000] text-2xl dark:text-slate-100 flex items-center justify-center gap-2">
                    به فروشگاه جوانه سبز خوش آمدید
                    <svg-component name="like" class="size-12 fill-none text-red-500"></svg-component>
                </div>
                <div class=" text-slate-500 text-xl dark:text-slate-200">دوست مهربان کشاورز ها</div>
            </div>
        </div>
    </div>
</template>
