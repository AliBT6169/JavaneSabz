<script setup>
    const props = defineProps(["label", "value","placeholderText"]);
</script>

<template>
    <div class="space-y-2">
        <label class="pr-2 text-black dark:text-white">{{label}}</label>
        <input type="text" class="w-full bg-transparent rounded-tr-2xl rounded-bl-2xl border-defaultColor
                        focus:ring-0 focus:border-defaultColor" :value="value" name="user-name" :placeholder="placeholderText">
    </div>
</template>
