<script setup>
import {onMounted, ref} from "vue";

const connectUsFormVisibility = ref(false);
onMounted(() => {
    setTimeout(()=>{
        connectUsFormVisibility.value = true;
        console.log(connectUsFormVisibility.value)
    },100)
});
</script>

<template class="relative">
    <div class="invisible opacity-0 absolute top-14 -right-40 size-96 rounded-xl bg-slate-800 lg:bg-opacity-50
     dark:bg-slate-50 lg:dark:bg-opacity-50 lg:dark:hover:bg-opacity-100 transition-all duration-500 lg:hover:bg-opacity-100"
     :class="{'!visible !opacity-100':connectUsFormVisibility}">

    </div>
</template>
