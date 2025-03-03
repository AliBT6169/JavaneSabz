<script setup>
import {useAuthStore} from "../Helper/authStore.js";
import {onMounted, ref} from "vue";

const authStore = ref(useAuthStore());
const props = defineProps({
    Sign: String,
});
onMounted(() => {
    setInterval(() => {
        authStore.value.toastCleaner();
    }, authStore.value.toastTimer??3000);
})

</script>

<template v-if="authStore.Toast!=null">
    <div class="absolute z-50 top-40 left-[calc(50vw-15rem)] space-y-6">
        <div v-for="item in authStore.Toast" class=" w-60 h-16 rounded-lg border bg-defaultColor5/50 text-white text-sm font-bold
    flex justify-center items-center toastAnimation">
            <div class="">{{ item[0] }}</div>
        </div>
    </div>
</template>
