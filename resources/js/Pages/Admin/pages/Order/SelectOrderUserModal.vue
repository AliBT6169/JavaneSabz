<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";

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
         :class="{'fixed z-50 top-20 left-7 !size-5/6 py-6 overflow-scroll':modal_status}">
        <div :class="{'hidden':!modal_status}" class="space-y-4 w-full">
            <div @click="emit('update:modelValue',item.id)" v-for="item in users"
                 class="rounded-xl duration-500 border-2 p-1 border-transparent"
                 :class="{'!border-red-500':modelValue===item.id}">
                <div
                    class="border-2 rounded-xl space-y-2 place-items-center overflow-hidden w-full pl-4 *:w-full border-adminColor3
                    *:text-center *:flex *:items-center *:gap-2 *:justify-center lg:*:w-72 lg:flex lg:justify-between lg:space-y-0 lg:items-center">
                    <div class="!size-14 rounded-full m-auto md:m-0 overflow-hidden">
                        <img :src="item.user_image===''?'/images/default/default.jpg':item.user_image" alt="">
                    </div>
                    <div class="">
                        <div class="">نام:</div>
                        <div class="text-wrap text-left">{{ item.full_name }}</div>
                    </div>
                    <div class="">
                        <div class="">نام کاربری:</div>
                        <div class="text-wrap text-left">{{ item.user_name }}</div>
                    </div>
                    <div class="">
                        <div class="">ایمیل:</div>
                        <div class="text-wrap text-left">{{ item.email }}</div>
                    </div>
                    <div class="">
                        <div class="">شماره تلفن:</div>
                        <div class="text-wrap text-left">{{ item.cellphone }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div @click.stop="modal_status = true" class="flex justify-center items-center cursor-pointer m-auto duration-300
        size-full rounded-xl border-4 border-adminColor2 dark:border-adminColor3 hover:scale-95 overflow-hidden"
             :class="{'hidden':modal_status}">انتخاب کاربر
        </div>
    </div>
</template>
