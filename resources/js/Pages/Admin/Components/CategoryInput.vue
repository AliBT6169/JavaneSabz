<script setup>
import {onMounted} from "vue";

onMounted(async () => {
    await axios.get(route('admin.categories.show')).then((res) => {
        console.log(res.data);
    }).catch((err) => {
        console.log(err.data);
    });
});
</script>

<template>

</template>
