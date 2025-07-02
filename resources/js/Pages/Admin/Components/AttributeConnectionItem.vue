<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";

const props = defineProps({
    modelName: {
        required: true,
    },
    modelValue: {
        required: true
    }
});
const emit = defineEmits(["update:modelValue"]);
const modal = ref();
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
onMounted(() => {
    document.addEventListener('click', modalCloser);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
</script>

<template>
    <div class="size-40 flex !justify-center bg-adminColor2 duration-500 overflow-hidden rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 size-5/6 py-6 overflow-scroll':modal_status}">
        <div v-if="!modal_status" @click.stop="modal_status=true" ref="modal"
             class="size-40 rounded-xl border-2 border-current flex justify-center items-center">{{
                modelName
            }}
        </div>
        <div v-else class=""></div>
    </div>
</template>
