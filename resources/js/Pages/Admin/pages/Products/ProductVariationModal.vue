<script setup>
import {ref} from "vue";

const modal = ref('');
const modal_status = ref(false);
document.addEventListener('click', (e) => {
    if (e.target !== modal.value)
        modal_status.value = false;
})
</script>

<template>
    <div class="size-40 flex justify-center items-center bg-adminColor2 duration-500 rounded-xl border" ref="modal"
         :class="{'fixed z-50 top-20 size-5/6':modal_status}"
         @click="modal_status = true">
        <div class="size-1/2 bg-red-500"></div>
    </div>
</template>
