<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    modelValue: null
});

const province = ref(null);
const city = ref(null);
const provinces = ref();
const cities = ref();
const emit = defineEmits(["update:modelValue"]);

onMounted(async () => {
    if (props.modelValue != null) {
        await axios.get(route('provinces')).then((res) => {
            provinces.value = res.data;
        }).catch((err) => {
            console.log(err)
        });
        await axios.get(route('cities', {province_id: province.value.value})).then((res) => {
            cities.value = res.data;
        }).catch((err) => {
            console.log(err);
        });
    }
    await axios.get(route('provinces')).then((res) => {
        provinces.value = res.data;
    }).catch((err) => {
        console.log(err)
    });
    await axios.get(route('cities', 1)).then((res) => {
        cities.value = res.data;
    }).catch((err) => {
        console.log(err);
    });
})

const getCities = async () => {
    await axios.get(route('cities', {province_id: province.value.value})).then((res) => {
        cities.value = res.data;
    }).catch((err) => {
        console.log(err);
    });
}
</script>

<template>
    <div class="!block text-black space-y-2 sm:space-y-0 sm:!flex gap-2 items-center *:w-full">
        <div class="">
            <label class="pr-2 text-black dark:text-white">استان :</label>
            <select name="province" id="province" ref="province" class="admin_inputs pr-10" @change="getCities">
                <option selected :value="modelValue.province_id">{{ modelValue.province }}</option>
                <option v-for="item in provinces" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
        <div class="">
            <label class="pr-2 text-black dark:text-white">شهر :</label>
            <select name="city" id="city" ref="city" class="admin_inputs pr-10"
                    @change="()=>emit('update:modelValue',city.value)">
                <option selected :value="modelValue.city_id">{{ modelValue.city }}</option>
                <option v-for="item in cities" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>
