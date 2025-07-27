<script setup>
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";
import PanelCommentItem from "@/Pages/Components/Panel/PanelCommentItem.vue";

const comments = ref(useAuthStore().user.comments);
console.log(comments.value);
</script>

<template>
    <div class="flex flex-wrap justify-center gap-5">
        <PanelCommentItem v-for="item in comments" :comment-data="item"/>
    </div>
</template>
