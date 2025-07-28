<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";

const mailModalStatus = ref(false);
const mailModal = ref();
const mails = ref([]);
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
})
</script>

<template>
    <div ref="mailModal" class="relative">
        <svg-component name="mail" class="size-7 sm:size-10"
                       @click="mailModalStatus = !mailModalStatus"/>
        <div class="z-30 size-96 duration-300 border-4 bg-adminColor1 border-adminColor3 rounded-xl absolute invisible top-60 right-0 opacity-0 dark:bg-adminColor4 dark:border-adminColor3"
             :class="{'!visible !opacity-100 !top-10':mailModalStatus}"></div>
    </div>
</template>
