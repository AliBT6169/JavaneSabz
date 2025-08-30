<script setup>
import IndexLyout from "@/Pages/IndexLyout.vue";
import ProductSlider1 from "@/Pages/Components/Home/product-slider1.vue";

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});
console.log(props.data);
</script>

<template>
    <IndexLyout>
        <!--        product show-1-->
        <div data-aos="fade-up" class="w-full mx-auto !transform-none">
            <div class="w-fit !static mx-auto flex flex-col gap-2 text-4xl md:m-0">
                <div class="flex gap-2">
                    <span class="">محصولات</span>
                    <span class="font-black text-defaultColor5">تخفیف دار</span>

                </div>
                <div class="flex gap-2 h-2">
                    <span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span>
                    <span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span>
                </div>
            </div>
            <product-slider1 :products="data.havOffSale.data" class="w-full"/>
        </div>
    </IndexLyout>
</template>
