<script setup lang="ts">

import Layout from "@/Pages/Admin/Components/Layout.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import {ref} from "vue";
import SMSCardComponent from "@/Pages/Admin/Components/SMSCardComponent.vue";
import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    messages: {
        type: Object,
    }
})
console.log(props.messages)
const loading = ref(false);
</script>

<template>
    <Layout>
        <LoadingComponent :loading="loading"/>
        <div class="space-y-5">
            <p class="text-lg font-bold text-center">
                پیامک های ارسالی
            </p>
            <Link :href="route('admin.sms.create')"
                  class="flex gap-0.5 justify-center items-center w-40 h-10 rounded-md text-center m-auto text-sm font-bold border-2 border-adminColor2 dark:border-adminColor4">
                <p class="">ایجاد پیام جدید</p>
                <SvgComponent name="mail" class="size-4"/>
            </Link>
            <div class="space-y-2">
                <SMSCardComponent v-for="(item, index) in messages.data" :key="index" :sms="item"/>
            </div>
        </div>
    </Layout>
</template>
