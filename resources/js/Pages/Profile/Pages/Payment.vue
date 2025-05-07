<script setup>
import {Link, router} from "@inertiajs/vue3";

const props = defineProps({
    response: null,
    order_id: Number
})
console.log(props.response.message);
console.log(props.order_id)
</script>

<template>
    <div class="w-screen h-screen flex justify-center items-center"
         :class="{'*:bg-defaultColor5':response.status===200,
            '*:bg-red-500':response.status===400,
            '*:bg-yellow-500':response.status===500}">
        <div class="p-20 rounded-2xl space-y-6 font-extrabold text-2xl text-center">
            <div class="">
                {{ response.message }}
            </div>
            <Link :href="route('dashboard')" class="block bg-defaultColor2 p-2 rounded-xl">
                برگشت به پروفایل
            </Link>
        </div>
    </div>

</template>
