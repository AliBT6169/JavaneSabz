<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    label: {
        type: String,
        required: true
    },
    modelValue: {
        required: true,
    },
});
const emit = defineEmits(["update:modelValue"]);
const provinces = ref();
const cities = ref();
const province = ref(null);

onMounted(async () => {
    await axios.get(route("cities", props.modelValue === '' ? 126 : props.modelValue)).then(res => {
        provinces.value = res.data.provinces;
        province.value = res.data.province.id;
        cities.value = res.data.cities;
        emit("update:modelValue", res.data.city.id);
    }).catch(err => {
    });
})

const setProvince = async (province_id) => {
    await axios.get(route('getCities', province_id)).then((res) => {
        cities.value = res.data;
    }).catch((err) => {
    });
}
</script>

<template>
    <div class="space-y-2">
        <label class="pr-2 text-black dark:text-white">{{ label }}</label>
        <div class="text-black space-y-2 sm:space-y-0 sm:flex gap-2 items-center *:rounded-tr-full *:rounded-bl-full *:border-defaultColor *:w-full *:bg-transparent
                focus:*:ring-0 focus:*:border-defaultColor3 dark:focus:*:border-defaultColor3 *:dark:border-defaultColor5">
            <select name="province" id="province" class="" @change="setProvince($event.target.value)">
                <option v-for="item in provinces" :selected="item.id === province" :value="item.id">{{
                        item.name
                    }}
                </option>
            </select>
            <select name="city" id="city" class="" @change="emit('update:modelValue',$event.target.value)">
                <option v-for="item in cities" :selected="modelValue === item.id" :value="item.id">{{
                        item.name
                    }}
                </option>
            </select>
        </div>
    </div>
</template>
