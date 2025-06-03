<script setup>
import {onMounted, ref} from "vue";

const emit = defineEmits({
    selected: null,
})
const Categories = ref();
onMounted(async () => {
    await axios.get(route('admin.categories.show')).then((res) => {
        Categories.value = res.data.data;
        console.log(res.data.data);
    }).catch((err) => {
        console.log(err.data);
    });
});
</script>

<template>
    <input class="admin_inputs" list="Categories" name="Categories">
    <datalist id="Categories">
        <option v-for="item in Categories" :value="item.name" @click="(e)=>console.log(item.id)">{{ item.name }}</option>
    </datalist>
</template>
