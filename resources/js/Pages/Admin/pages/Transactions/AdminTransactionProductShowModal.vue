<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import AdminTransactionOrderItem from "@/Pages/Admin/Components/Transaction/AdminTransactionOrderItem.vue";

const props = defineProps({
    products: {
        required: true,
    }
});
const modal = ref('');
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
onMounted(() => {
    document.addEventListener('click', modalCloser);
});
onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
</script>

<template>
    <div class="w-40 h-12 flex !justify-center bg-adminColor2 duration-500 overflow-hidden rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 left-7 !size-5/6 py-6 overflow-scroll':modal_status}">
        <div :class="{'hidden':!modal_status}" class="w-full *:m-auto items-center flex gap-6 justify-center flex-wrap">
            <AdminTransactionOrderItem v-for="item in products" :order-item="item"/>
        </div>
        <div @click.stop="modal_status = true" class="flex justify-center items-center cursor-pointer m-auto duration-300
        size-full rounded-xl border-4 border-adminColor2 dark:border-adminColor3 hover:scale-95 overflow-hidden"
             :class="{'hidden':modal_status}">نمایش محصولات
        </div>
    </div>
</template>
