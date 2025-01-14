<script setup>
import {onMounted, ref} from "vue";

const connectUsFormVisibility = ref(false);
onMounted(() => {
    setTimeout(() => {
        connectUsFormVisibility.value = true;
        console.log(connectUsFormVisibility.value)
    }, 100)
});
</script>

<template class="relative">
    <div class="invisible opacity-0 absolute top-14 -right-40 size-96 rounded-xl bg-slate-800 lg:bg-opacity-50
     dark:bg-slate-50 lg:dark:bg-opacity-50 lg:dark:hover:bg-opacity-100 transition-all duration-500 lg:hover:bg-opacity-100"
         :class="{'!visible !opacity-100':connectUsFormVisibility}">
        <div class="size-full p-4 items-center gap-10 flex flex-col">
            <div class="w-full h-fit justify-between items-center text-nowrap flex gap-2 dark:text-black">
                <label for="name">نام :</label>
                <input id="name" type="text" class="text-sm rounded-xl text-black bg-slate-200 dark:bg-gray-700 dark:text-white">
            </div>
            <div class="w-full h-fit text-nowrap flex gap-2 items-center justify-between dark:text-black">
                <label for="lastName">نام خانوادگی:</label>
                <input id="lastName" type="text" class="text-sm rounded-xl text-black bg-slate-200 dark:bg-gray-700 dark:text-white">
            </div>
        </div>
    </div>
</template>
