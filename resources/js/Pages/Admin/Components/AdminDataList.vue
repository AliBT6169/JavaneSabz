<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    route: ''
});
const emit = defineEmits({
    selected: null,
})
const listData = ref();
onMounted(async () => {
    await axios.get(route(props.route)).then((res) => {
        listData.value = res.data.data;
        console.log(res.data.data);
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
    <input class="admin_inputs" list="dataList" name="DataList" @input="dataSender($event.target.value)">
    <datalist id="dataList">
        <option v-for="item in listData" :value="item.name">{{ item.name }}</option>
    </datalist>
</template>
