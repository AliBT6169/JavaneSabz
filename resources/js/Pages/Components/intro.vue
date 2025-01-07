<script setup>

import SvgComponent from "@/Components/svg-component.vue";
import {onMounted, ref} from "vue";

const isVisible=ref(true);
onMounted(()=>{
    setTimeout(()=>{
        isVisible.value=false
    },3000)
});

</script>

<template>
    <div v-if="isVisible" class="top-0 bg-slate-800 bg-opacity-80 z-50 w-screen h-full absolute flex items-center duration-1000 ease-in justify-center introView"
         >
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
<style>

.introView {
    animation: introOut 5s;
}

@keyframes introOut {
    30%{
        top: 0;
    }
    50%{
        top: 100px;
    }
    100%{
        top: -5000px;
    }
}
</style>
