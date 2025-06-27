<script setup>
import {ref} from "vue";

const props = defineProps({
    modelValue: ''
});
const emit = defineEmits(['update:modelValue']);

const showingImage = ref(props.modelValue === '' ? '/images/default/product.png' : props.modelValue);
const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('image', event.target.files[0]);
        emit('update:modelValue', formData)
        const reader = new FileReader();
        reader.onloadend = (e) => {
            showingImage.value = e.target.result;
        };
        reader.readAsDataURL(file);

    } else {
        showingImage.value = '';
    }
}
</script>

<template>

    <label for="image" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
        <input type="file" id="image" accept="*image/*" class="invisible absolute" @change="onFileChange">
        <img :src="showingImage"
             class="size-full"
             alt="">
    </label>
</template>
