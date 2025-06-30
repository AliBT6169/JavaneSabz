<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    default_value: 0,
    route: '',
    label: ''
});
const selected_value = ref(props.default_value);
const emit = defineEmits({
    selected: null,
})
const listData = ref();
onMounted(async () => {
    await axios.get(route(props.route)).then((res) => {
        listData.value = res.data.data;
    }).catch((err) => {
        console.log(err.data);
    });
    if (props.default_value !== 0) {
        dataSender(props.default_value);
    }
});
const dataSender = (value) => {
    let key = listData.value.map((item) => {
        if (item.name === value) {
            emit('selected', item.id);
            selected_value.value = item.name;
        }
    });
}
</script>

<template>
    <div class="w-full">
        <div class="text-sm px-3">{{ label }} :</div>
        <input class="admin_inputs" :list="'dataList'+label" name="DataList" :value="selected_value" autocomplete="off"
               @input="dataSender($event.target.value)">
        <datalist :id="'dataList'+label">
            <option v-for="item in listData" :value="item.name">{{ item.name }}</option>
        </datalist>
    </div>
</template>
