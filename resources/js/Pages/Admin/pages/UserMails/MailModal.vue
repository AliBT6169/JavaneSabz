<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";

const mailModalStatus = ref(false);
const mailModal = ref();
const mails = ref([]);
const mailSeen = ref(false);
const closeMailModal = (e) => {
    if (!mailModal.value.contains(e.target) && mailModalStatus.value) {
        mailModalStatus.value = false;
    }
}

onMounted(async () => {
    await axios.get(route('admin.getUsersNotSeenMails')).then(res => {
        mails.value = res.data;
    }).catch(err => {

    });
    document.addEventListener("click", closeMailModal);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", closeMailModal);
});
const mailSVGClick = async () => {
    mailModalStatus.value = !mailModalStatus.value;
    if (!mailSeen.value) {
        await axios.get(route('admin.seenAllMails')).then(res => {

        }).catch(err => {

        });
        mailSeen.value = true;
    }
}
</script>

<template>
    <div ref="mailModal" class="relative cursor">
        <div
            :class="{'relative before:absolute before:size-4 before:z-50 before:bg-red-500 before:rounded-full before:bottom-0 before:left-0':!mailSeen&&mails.length>0}">
            <svg-component name="mail" class="size-7 sm:size-10"
                           @click="mailSVGClick"/>
        </div>
        <div
            class="z-30 size-80 overflow-y-auto no-scrollbar duration-300 border-4 bg-adminColor1 border-adminColor3 rounded-xl absolute invisible top-60 right-0 opacity-0 dark:bg-adminColor4"
            :class="{'!visible !opacity-100 !top-10':mailModalStatus}">
            <div class="text-sm py-2 space-y-5 *:border-b-2 *:p-4 *:border-adminColor3">
                <div v-if="mails.length>0" v-for="item in mails" class="space-y-1">
                    <div class="flex justify-between gap-2 items-center">
                        <div class="">نام: {{ item.name }}</div>
                        <div class="">شماره: {{ item.phone }}</div>
                    </div>
                    <div class="border p-2 rounded-xl dark:text-white">{{ item.text }}</div>
                </div>
                <div v-else class="text-center">
                    پیام جدیدی موجود نیست!
                </div>
                <Link :href="route('admin.userMails.index')" class="border-2 rounded-xl text-center mx-5 duration-300 hover:scale-95">مشاهده همه پیام ها</Link>
            </div>
        </div>
    </div>
</template>
