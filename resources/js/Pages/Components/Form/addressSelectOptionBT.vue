<script setup>
const props = defineProps(["value", "label"])

</script>

<template>
    <div class="space-y-2">
        <label class="pr-2 text-black dark:text-white">{{ label }}</label>
        <div class="text-black flex gap-2 items-center *:rounded-tr-full *:rounded-bl-full *:border-defaultColor *:w-full *:bg-transparent
                focus:*:ring-0 focus:*:border-defaultColor3 dark:focus:*:border-defaultColor3 *:dark:border-defaultColor5">
            <select name="city" id="city" class="">
                <option selected value="">شهر</option>
                <option v-for="item in 5" value="">شهر</option>
            </select>
            <select name="city" id="city" class="">
                <option selected value="">استان</option>
                <option v-for="item in 5" value="">استان</option>
            </select>
        </div>
    </div>
</template>
