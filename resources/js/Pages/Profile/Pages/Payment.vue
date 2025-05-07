<script setup>
import {Link, router} from "@inertiajs/vue3";

const props = defineProps({
    transaction_data: null,
})
console.log(props.transaction_data);
</script>

<template>
    <div class="w-screen h-screen flex justify-center items-center"
    >
        <div class="p-20 rounded-2xl space-y-6 font-extrabold text-2xl text-center"
             :class="{
            'bg-blue-500':transaction_data[0].status===1,
            'bg-yellow-500':transaction_data[0].status===2,
            'bg-red-500':transaction_data[0].status===3,
             }">
            <div v-if="transaction_data[0].status===1" class="">
                تراکنش موفق
            </div>
            <div v-if="transaction_data[0].status===2" class="">
                تراکنش نامعلوم
            </div>
            <div v-if="transaction_data[0].status===3" class="">
                تراکنش ناموفق
            </div>
            <Link :href="route('dashboard')" class="block bg-defaultColor2 p-2 rounded-xl">
                برگشت به پروفایل
            </Link>
        </div>
    </div>

</template>
