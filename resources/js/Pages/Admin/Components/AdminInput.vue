<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {onBeforeUnmount, onMounted, ref} from "vue";

const props = defineProps({
    name: '',
    type: {
        default: 'text'
    },
    modelValue: '',
    icon: ''
});
const inputNumber = ref();

const emit = defineEmits({
    'update:modelValue': '',
    'input': '',
})
</script>

<template>
    <div class="relative w-full">
        <div class="text-sm px-3">{{ name }} :</div>
        <input autocomplete="off" :type="type" v-if="type==='text'" :placeholder="name" :value="modelValue"
               @input="emit('update:modelValue',$event.target.value)"
               class="admin_inputs">
        <input ref="inputNumber" type="text" v-else-if="type==='number'" :placeholder="name"
               :value="Number(modelValue).toLocaleString('en-US')"
               @input="emit('update:modelValue',Number($event.target.value.replace(/,/g,''))),emit('input',Number($event.target.value.replace(/,/g,'')))"
               class="admin_inputs">
        <input autocomplete="new-password" :type="type" v-else-if="type==='password'" :placeholder="name" :value="modelValue"
               @input="emit('update:modelValue',$event.target.value)"
               class="admin_inputs">
        <svg-component v-if="icon!==''" :name="icon" class="size-5 absolute left-1 top-4 z-50 text text-black"/>
    </div>
</template>
