<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";

const props = defineProps({
    name: '',
    type: 'text',
    default_value: '',
    icon: ''
});
</script>

<template>
    <div class="relative">
        <div class="text-sm px-3">{{name}} :</div>
        <input :type="type" :placeholder="name" :value="default_value"
               class="p-3 w-full rounded-lg border-adminColor2 border-2 placeholder-adminColor2 focus:ring-adminColor2
                focus:border-adminColor2 dark:bg-gray-600 dark:placeholder-adminColor4">
        <svg-component v-if="icon!==''" :name="icon" class="size-5 absolute left-1 top-4 z-50 text-black"/>
    </div>
</template>
