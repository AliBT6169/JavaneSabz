<script setup>
import {onMounted, ref} from "vue";
import InputBT1 from "@/Pages/Components/Form/Input-BT1.vue";
import ButtonBT1 from "@/Pages/Components/Form/Button-BT1.vue";
import {connectUsModalVisibility} from "@/Pages/Components/Helper/Helper.js";

const connectUsFormVisibility = ref(false);
onMounted(() => {
    setTimeout(() => {
        connectUsFormVisibility.value = true;
    }, 100)
});
</script>

<template>
    <div
        class="h-screen w-screen fixed z-20 top-0 left-0 bg-slate-800 bg-opacity-50 flex items-center justify-center">
        <div class="invisible opacity-0 border-2 border-defaultColor5 -translate-y-96 h-fit w-72 rounded-xl bg-slate-800 lg:bg-opacity-50
        dark:bg-slate-500 lg:dark:bg-opacity-50 py-4 lg:dark:hover:bg-opacity-100 transition-all duration-500
         lg:hover:bg-opacity-100 md:w-96"
             :class="{'!visible !translate-y-0 !opacity-100':connectUsFormVisibility}">
            <form class="size-full p-4 items-center gap-2 flex flex-col" @click.stop>
                <div class="text-lg font-bold text-defaultColor5 border-x-4 rounded-2xl p-1 border-defaultColor">برای ما
                    پیام بفرستید
                </div>
                <InputBT1 label-text="نام و نام خانوادگی:"></InputBT1>
                <InputBT1 label-text="شماره همراه:"></InputBT1>
                <InputBT1 label-text="پیام:" multi-line="true"></InputBT1>
                <div class="flex w-full justify-end gap-2 items-center">
                    <ButtonBT1 button-text="ارسال" buton-type="submit"></ButtonBT1>
                    <ButtonBT1 button-text="لغو" button-type="reset"
                               @click="connectUsModalVisibility=false"></ButtonBT1>
                </div>
            </form>
        </div>
    </div>

</template>
