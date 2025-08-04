<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";

const props = defineProps({
    modelName: {
        required: true,
    },
});
const modal = ref();
const modal_status = ref(false);

onMounted(async () => {
    document.addEventListener('click', modalCloser);
});

const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
</script>

<template>
    <div
        class="w-[5.5rem] flex !justify-center bg-adminColor2 duration-500 transition-all overflow-hidden rounded-xl
         border-2 border-current dark:bg-adminColor3"
        ref="modal"
        :class="{'fixed z-50 top-20 no-scrollbar !size-5/6 py-6 overflow-scroll !bg-adminColor1 dark:!bg-adminColor3 left-10':modal_status,' hover:scale-95':!modal_status}">
        <div v-if="!modal_status" @click.stop="modal_status = true" ref="modal"
             class="size-fit flex justify-center cursor-pointer overflow-hidden items-center px-3 ">
            {{ modelName }}
        </div>
        <div v-else class="">
            <div class="p-5 space-y-4">
                <div class="text-center p-2 rounded-xl border-2 border-red-500">
                    <strong class="text-yellow-300">هشدار: </strong>
                    خصوصیت های انتخاب شده نباید محصول و موجودیت محصول داشته باشند!
                </div>

            </div>
        </div>
    </div>
</template>
