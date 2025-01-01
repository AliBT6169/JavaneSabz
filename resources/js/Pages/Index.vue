<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import Slider1 from "@/Pages/Components/Slider1.vue";
import Brands from "@/Pages/Components/Brands.vue";
import {ref} from "vue";

const brandsData=ref([
    "../../../../images/brands/advanced-nutrients.webp",
    "../../../../images/brands/ardin.webp",
    "../../../../images/brands/argeto.webp",
    "../../../../images/brands/ariashimi.webp",
    "../../../../images/brands/asia-seed.webp",
    "../../../../images/brands/baghbantak.webp",
    "../../../../images/brands/barenbrug.webp",
    "../../../../images/brands/behcam.webp",
    "../../../../images/brands/biobizz.webp",
    "../../../../images/brands/continental-semences.webp.webp",
]);
</script>

<template class="">
    <Header></Header>
    <slider1></slider1>
    <Brands class="mb-96" :brands-data="brandsData"></Brands>
    <Footer></Footer>
</template>
<style>

</style>
