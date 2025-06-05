<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    route: '',
    label: ''
});
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
});
const dataSender = (value) => {
    let key = listData.value.map((item) => {
        if (item.name === value)
            emit('selected', item.id);
    });
}
</script>

<template>
    <div class="w-full">
        <div class="text-sm px-3">{{ label }} :</div>
        <input class="admin_inputs" :list="'dataList'+label" name="DataList" @input="dataSender($event.target.value)">
        <datalist :id="'dataList'+label">
            <option v-for="item in listData" :value="item.name">{{ item.name }}</option>
        </datalist>
    </div>
</template>
