<script setup>
    import {ref} from "vue";

    const productCount=ref(10)
</script>

<template>
    <div v-if="productCount>0" class="grid select-none shadow-md duration-300 shadow-slate-600 place-items-center place-self-center gap-4 w-fit
        py-2 px-4 rounded-xl border-2 border-defaultColor dark:border-defaultColor5 hover:shadow-lg hover:shadow-slate-600
        sm:flex xl:w-full xl:justify-between">
        <div class="w-40 rounded-lg cursor-pointer overflow-hidden">
            <img src="/images/products/Emamectin.jpg" alt="Emamectin" class="duration-300 hover:scale-110">
        </div>
        <span class="">امامکتین بنزوات</span>
        <p class="">مخصوص کشتن حشرات</p>
        <div class="flex items-center gap-1">تعداد:
            <div
                class="mr-4 !overflow-hidden *:px-2 border-black text-lg font-bold border rounded-xl dark:border-white">
                <span  @click="productCount++" class=" cursor-pointer bg-defaultColor dark:bg-defaultColor5 bg-opacity-80">+</span>
                <span>{{productCount}}</span>
                <span @click="productCount>0?productCount--:''" class="cursor-pointer bg-red-600 bg-opacity-80">-</span>
            </div>
        </div>
        <div class="*:px-2"><span>قیمت:</span> <span>100,000</span></div>
    </div>
</template>
