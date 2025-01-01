<script setup>
    import {onMounted} from "vue";

    const props = defineProps(["brandsData"]);
    onMounted(()=>{
        console.log(props.brandsData);
    });
</script>

<template>
    <div class="w-[80rem] mx-auto overflow-x-scroll">
        <div class="flex w-fit text-xs gap-4 mt-4 py-5">
            <div class="brand-list" v-for="item in props.brandsData">
                <img :src="item" alt="" class="brands-image"
                     @dragstart.prevent>
            </div>
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/agro-zold.webp" alt="" class="brands-image"-->
<!--                     @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/ardin.webp" alt="" class="brands-image" @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/argeto.webp" alt="" class="brands-image" @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/ariashimi.webp" alt="" class="brands-image"-->
<!--                     @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/asia-seed.webp" alt="" class="brands-image"-->
<!--                     @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/baghbantak.webp" alt="" class="brands-image"-->
<!--                     @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/barenbrug.webp" alt="" class="brands-image"-->
<!--                     @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/behcam.webp" alt="" class="brands-image" @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/behco.webp" alt="" class="brands-image" @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/biobizz.webp" alt="" class="brands-image" @dragstart.prevent>-->
<!--            </div>-->
<!--            <div class="brand-list">-->
<!--                <img src="../../../../public/images/brands/continental-semences.webp" alt="" class="brands-image"-->
<!--                     @dragstart.prevent>-->
<!--            </div>-->
        </div>
    </div>
</template>
