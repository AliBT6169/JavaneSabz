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

<template class="relative">
    <div class="invisible opacity-0 absolute top-14 -right-40 size-96 rounded-xl bg-slate-800 lg:bg-opacity-50
     dark:bg-slate-500 lg:dark:bg-opacity-50 lg:dark:hover:bg-opacity-100 transition-all duration-500 lg:hover:bg-opacity-100"
         :class="{'!visible !opacity-100':connectUsFormVisibility}">
        <div class="size-full p-4 items-center gap-5 flex flex-col">
            <InputBT1 label-text="نام :"></InputBT1>
            <InputBT1 label-text="نام خانوادگی:"></InputBT1>
            <InputBT1 label-text="شماره همراه:"></InputBT1>
            <InputBT1 label-text="ایمیل (اختیاری):"></InputBT1>
        </div>
    </div>
</template>
