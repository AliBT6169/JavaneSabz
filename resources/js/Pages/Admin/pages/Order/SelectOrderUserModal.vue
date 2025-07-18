<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import AdminOrderProductSelectItem from "@/Pages/Admin/Components/Order/AdminOrderProductSelectItem.vue";
import SelectOrderUserModalItem from "@/Pages/Admin/pages/Order/SelectOrderUserModalItem.vue";

const props = defineProps({
    modelValue: {
        required: true,
    }
});
const emit = defineEmits(['update:modelValue']);

const modal = ref('');
const modal_status = ref(false);
const users = ref();
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
onMounted(() => {
    document.addEventListener('click', modalCloser);
    axios.get(route('admin.users.showAll')).then(res => {
        users.value = res.data;
        console.log(users.value)
    }).catch(err => {
        console.log(err);
    });
});
onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
</script>

<template>
    <div class="size-40 flex !justify-center bg-adminColor2 duration-500 overflow-hidden rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 size-fit md:size-5/6 py-6 overflow-scroll':modal_status}">
        <div :class="{'hidden':!modal_status}" class="flex gap-5 justify-center flex-wrap">
            <SelectOrderUserModalItem v-for="item in users" :user="item"/>
        </div>
        <div @click.stop="modal_status = true" class="flex justify-center items-center cursor-pointer m-auto duration-300
        size-full rounded-xl border-4 border-adminColor2 dark:border-adminColor3 hover:scale-95 overflow-hidden"
             :class="{'hidden':modal_status}">انتخاب کاربر
        </div>
    </div>
</template>
