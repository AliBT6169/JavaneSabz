<script setup>
import {Link, router} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

const props = defineProps({
    transaction_data: null,
    message: null,
})
console.log(props.transaction_data);
switch (props.transaction_data[0].status) {
    case 1:
        useAuthStore().toastMessage('success', props.message)
        break;
    case 2:
        useAuthStore().toastMessage('warning', props.message)
        break;
    case 3:
        useAuthStore().toastMessage('error', props.message)
}
</script>

<template>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="p-20 rounded-2xl space-y-6 font-extrabold text-2xl text-center
        *:flex *:gap-4 *:items-center *:p-2 *:rounded-xl *:justify-center"
             :class="{
            'bg-blue-500 *:bg-green-200':transaction_data[0].status===1,
            'bg-yellow-500 *:bg-yellow-200':transaction_data[0].status===2,
            'bg-red-500 *:bg-red-200':transaction_data[0].status===3,
             }">
            <div v-if="transaction_data[0].status===1" class="">
                تراکنش موفق
                <svg-component name="tick" class="size-20 text-green-500"/>
            </div>
            <div v-if="transaction_data[0].status===2" class="">
                تراکنش نامعلوم
                <svg-component name="info" class="size-20 text-yellow-500"/>
            </div>
            <div v-if="transaction_data[0].status===3" class="">
                تراکنش ناموفق
                <svg-component name="close" class="size-20 text-red-500"/>
            </div>
            <Link :href="route('dashboard')" class="py-2 duration-300 hover:scale-95 hover:bg-opacity-50">
                برگشت به پروفایل
            </Link>
        </div>
    </div>

</template>
