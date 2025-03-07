<script setup>
import 'vue3-carousel/carousel.css'
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

const carouselConfig = {
    itemsToShow: 2.5,
    wrapAround: true
}
</script>

<template>
    <Carousel v-bind="carouselConfig">
        <Slide v-for="slide in 3" :key="slide">
            <div class="size-96 bg-defaultColor5" id="{{'slide' + slide}}" :key="slide"></div>
        </Slide>

        <template #addons>
            <Navigation />
            <Pagination />
        </template>
    </Carousel>
</template>
