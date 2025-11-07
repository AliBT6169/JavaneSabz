<script setup>

import Layout from "@/Pages/Admin/Components/Layout.vue";
import {ref} from "vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";
import AdminTextArea from "@/Pages/Admin/Components/AdminTextArea.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";


const smsForm = ref({
    message: '',
});
const loading = ref(false);
const sendSMS = async () => {
    loading.value = true;
    await axios.post(route('admin.sms.store'), smsForm.value).then(response => {
        loading.value = false;
    }).catch(error => {
        loading.value = false;
    });
}
</script>

<template>
    <Layout>
        <LoadingComponent :loading="loading"/>
        <div class="space-y-5">
            <p class="text-lg font-bold text-center"> :ارسال پیام</p>
            <form @submit.prevent="sendSMS" class="space-y-5">
                <AdminTextArea label="متن پیام :" v-model="smsForm.message"/>
                <AdminButton type="submit" text="ارسال" :disabled="loading"/>
            </form>
        </div>
    </Layout>
</template>
