<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";

const props = defineProps({
    mails: {
        type: Array,
        required: true
    },
})
</script>

<template>
    <Layout>
        <div class="flex flex-wrap justify-center items-center gap-5">
            <div v-for="item in mails.data" class="text-sm w-80 h-80 overflow-hidden rounded-xl border-2 border-adminColor2
            bg-adminColor1 p-2 space-y-4 dark:bg-adminColor4 md:text-base md:w-96">
                <div class="flex gap-10 justify-between items-center pb-2 border-b">
                    <div class="">نام: {{ item.name }}</div>
                    <div class="">شماره: {{ item.phone }}</div>
                </div>
                <div class="text-center">{{ item.created_at }}</div>
                <div class="border rounded-xl p-2 dark:text-white space-y-2">
                    <div class="">پیام:</div>
                    <p class="text-center h-40 no-scrollbar overflow-y-scroll">{{ item.text }}</p>
                </div>
            </div>
        </div>
    </Layout>
</template>
