<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {onMounted, ref} from "vue";

const isVisible=ref(true);
onMounted(()=>{
    setTimeout(()=>{
        isVisible.value=false
    },2700)
});

</script>

<template>
    <div v-if="isVisible" class="top-0 bg-slate-800 bg-opacity-80 z-50 w-screen h-full absolute flex items-center duration-1000 ease-in introView sm:justify-center "
         >
        <div class="flex items-center gap-1 justify-center text-white">
            <img src="../../../../public/logo/logo1.png" class="size-28 sm:size-52" alt="">
            <div class="w-0.5 h-10 bg-white rounded-full sm:w-2 sm:h-24"></div>
            <div class="flex gap-1 flex-col">
                <div class="font-[1000] text-lg dark:text-slate-100 flex items-center justify-center sm:text-2xl">
                    به فروشگاه جوانه سبز خوش آمدید
                    <svg-component name="like" class="fill-none text-red-500 size-12"></svg-component>
                </div>
                <div class=" text-slate-500 text-sm dark:text-slate-200 sm:text-xl">دوست مهربان کشاورز ها</div>
            </div>
        </div>
    </div>
</template>
<style>
</style>
