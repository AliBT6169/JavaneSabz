<script setup>
import {useAuthStore} from "../Helper/authStore.js";
import {onMounted, ref} from "vue";

const props = defineProps(["label"]);
const provinces = ref();
onMounted(() => {
    if (useAuthStore().user.user_address.address === '') {
        axios.get(route('provinces')).then((res) => {
            provinces.value = res.data;
            console.log(res.data);
        }).catch((err) => {
            console.log(err)
        });
    }

})

const getCities = (e) => {
    console.log(e)
}
</script>

<template>
    <div class="space-y-2">
        <label class="pr-2 text-black dark:text-white">{{ label }}</label>
        <div class="text-black flex gap-2 items-center *:rounded-tr-full *:rounded-bl-full *:border-defaultColor *:w-full *:bg-transparent
                focus:*:ring-0 focus:*:border-defaultColor3 dark:focus:*:border-defaultColor3 *:dark:border-defaultColor5">
            <select name="city" id="city" class="">
                <option selected value="">{{ useAuthStore().user.user_address.city.data }}</option>
                <option v-for="item in 5" value="">شهر</option>
            </select>
            <select name="province" id="province" class="" @change="(e)=>console.log(e.selectedIndex)">
                <option selected value="">{{ useAuthStore().user.user_address.province.data }}</option>
                <option v-for="item in provinces" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>
