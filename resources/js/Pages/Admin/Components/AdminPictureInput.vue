<script setup>
import {ref} from "vue";
import heic2any from "heic2any";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    modelValue: '',
    myKey: {
        type: String,
        default: '',
    }
});
const loading = ref(false);
const emit = defineEmits(['update:modelValue']);

const showingImage = ref(props.modelValue === '' ? '/images/default/product.png' : props.modelValue);
const onFileChange = async (event) => {
    loading.value = true;
    const file = await checkIfItsHEIC(event.target.files[0]);
    if (file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('key', props.myKey);
        emit('update:modelValue', formData)
        const reader = new FileReader();
        reader.onloadend = (e) => {
            showingImage.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        showingImage.value = '';
    }
    loading.value = false;
}

const checkIfItsHEIC = async (file) => {
    if (!file) return file;
    const converted = ref(file);
    if (file.name.toLowerCase().endsWith('.heic') || file.name.toLowerCase().endsWith('.heif')) {
        converted.value = await heic2any({
            blob: file,
            toType: "image/jpeg",
        });
    }
    return new File([converted.value], file.name.replace(/\.[^/.]+$/, ".jpg"), {
        type: "image/jpeg",
    });
}
</script>

<template>
    <LoadingComponent :loading="loading"/>
    <label :for="'image' + myKey" class="mb-4 cursor-pointer m-auto duration-300 size-40 rounded-full border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden">
        <input type="file" :id="'image' + myKey" accept="image/*" class="invisible absolute" @change="onFileChange">
        <img :src="showingImage"
             class="size-full"
             alt="">
    </label>
</template>
