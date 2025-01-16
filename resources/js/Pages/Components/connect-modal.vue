<script setup>
import {onMounted, ref} from "vue";
import InputBT1 from "@/Pages/Components/Form/Input-BT1.vue";

const connectUsFormVisibility = ref(false);
onMounted(() => {
    setTimeout(() => {
        connectUsFormVisibility.value = true;
    }, 100)
});
</script>

<template>
    <div class="h-screen w-screen absolute z-20 top-0 left-0 bg-slate-800 bg-opacity-50 flex items-center justify-center">
        <div class="invisible opacity-0 size-96 rounded-xl bg-slate-800 lg:bg-opacity-50
     dark:bg-slate-500 lg:dark:bg-opacity-50 lg:dark:hover:bg-opacity-100 transition-all duration-500 lg:hover:bg-opacity-100"
             :class="{'!visible !opacity-100':connectUsFormVisibility}">
            <div class="size-full p-4 items-center gap-2 flex flex-col">
                <div class="text-lg font-bold text-defaultColor5 border-x-4 rounded-2xl p-1 border-defaultColor">برای ما پیام بفرستید</div>
                <InputBT1 label-text="نام و نام خانوادگی:"></InputBT1>
                <InputBT1 label-text="شماره همراه:"></InputBT1>
                <InputBT1 label-text="پیام:" multi-line="true"></InputBT1>
            </div>
        </div>
    </div>

</template>
