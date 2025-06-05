<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";

const modal = ref('');
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target))
        modal_status.value = false;
}
onMounted(() => {
    document.addEventListener('click', modalCloser);
});

onBeforeUnmount(() => {
    document.removeEventListener('click',modalCloser);
});
</script>

<template>
    <div class="size-40 flex justify-center items-center bg-adminColor2 duration-500 rounded-xl border" ref="modal"
         :class="{'fixed z-50 top-20 size-5/6':modal_status}"
         @click="modal_status = true">
        <div class="size-1/2 bg-red-500"></div>
    </div>
</template>
