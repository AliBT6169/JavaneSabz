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
        <div class="p-20 rounded-2xl space-y-6 font-extrabold text-2xl text-center">
            <div class="">
            </div>
            <Link :href="route('dashboard')" class="block bg-defaultColor2 p-2 rounded-xl">
                برگشت به پروفایل
            </Link>
        </div>
    </div>

</template>
