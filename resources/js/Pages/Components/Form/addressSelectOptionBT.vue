<script setup>
import {useAuthStore} from "../Helper/authStore.js";
import {onMounted, ref, useTemplateRef} from "vue";

const props = defineProps(["label"]);
const provinces = ref();
const cities = ref();
const province = ref(null);
const city = ref(null);

onMounted(() => {
    if (useAuthStore().user.user_address.address === '') {
        axios.get(route('provinces')).then((res) => {
            provinces.value = res.data;
        }).catch((err) => {
            console.log(err)
        });
    }

})

const getCities = async () => {
    await axios.get(route('cities', {province_id: province.value.value})).then((res)=>{
        cities.value = res.data;
    }).catch((err)=>{
        console.log(err);
    })
}
</script>

<template>
    <div class="space-y-2">
        <label class="pr-2 text-black dark:text-white">{{ label }}</label>
        <div class="text-black flex gap-2 items-center *:rounded-tr-full *:rounded-bl-full *:border-defaultColor *:w-full *:bg-transparent
                focus:*:ring-0 focus:*:border-defaultColor3 dark:focus:*:border-defaultColor3 *:dark:border-defaultColor5">
            <select name="city" id="city" ref="city" class="">
                <option selected value="">{{ useAuthStore().user.user_address.city.data }}</option>
                <option v-for="item in cities" value="">{{ item.name }}</option>
            </select>
                <select name="province" id="province" ref="province" class="" @change="getCities">
                <option selected value="">{{ useAuthStore().user.user_address.province.data }}</option>
                <option v-for="item in provinces" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>
