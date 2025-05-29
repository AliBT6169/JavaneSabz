<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    label: null,
    address:null
});
const province = ref(null);
const city = ref(null);
const provinces = ref();
const cities = ref();
const emit = defineEmits(["updateValue"]);

onMounted(() => {
    axios.get(route('provinces')).then((res) => {
        provinces.value = res.data;
    }).catch((err) => {
        console.log(err)
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
            <label class="pr-2 text-black dark:text-white">{{ label }}</label>
            <select name="province" id="province" ref="province" class="p-3 w-full rounded-lg pr-10 border-adminColor2 bg-adminColor1 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4" @change="getCities">
                <option selected :value="props.address.province_id">{{ props.address.province }}</option>
                <option v-for="item in provinces" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
        <div class="">
            <label class="pr-2 text-black dark:text-white">{{ label }}</label>
            <select name="city" id="city" ref="city" class="p-3 w-full rounded-lg pr-10 border-adminColor2 bg-adminColor1 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4"
                    @change="()=>emit('updateValue',city.value)">
                <option selected :value="props.address.city_id">{{ props.address.city }}</option>
                <option v-for="item in cities" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>
