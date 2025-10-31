<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    modelValue: null,
});

const province = ref(null);
const provinces = ref();
const cities = ref();
const emit = defineEmits(["update:modelValue"]);

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
    <div class="!block text-black space-y-2 sm:space-y-0 sm:!flex gap-2 items-center *:w-full">
        <div class="">
            <label class="pr-2 text-black dark:text-white">استان :</label>
            <select name="province" id="province" class="admin_inputs pr-10"
                    @change="setProvince($event.target.value)">
                <option v-for="item in provinces" :selected="item.id===province" :value="item.id">{{
                        item.name
                    }}
                </option>
            </select>
        </div>
        <div class="">
            <label class="pr-2 text-black dark:text-white">شهر :</label>
            <select name="city" id="city" ref="city" class="admin_inputs pr-10"
                    @change="emit('update:modelValue',$event.target.value)">
                <option v-for="item in cities" :selected="item.id === modelValue" :value="item.id">{{ item.name }}</option>
            </select>
        </div>
    </div>
</template>
