<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import 'vue3-carousel/carousel.css'
import {Carousel, Slide, Pagination} from 'vue3-carousel';
import Navigation from "@/Pages/Components/Home/navigation.vue";

const carouselConfig = {
    itemsToShow: 1,
    autoplay: 3000,
    dir: 'rtl',
    gap: 1,
    wrapAround: true,
    breakpointMode: 'carousel',
}
const props = defineProps(["product"]);
console.log(props.product.data);
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Header/>
        <Navigation/>
        <div class="w-full space-y-6 pb-96 text-defaultColor dark:text-defaultColor5 md:text-xl">
            <!--        page location-->
            <div class="w-full flex">
                <div class="flex items-center w-fit gap-2">
                    <Link href="/">
                <span
                    class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                    </Link>
                    <svg-component name="next" class="size-3"></svg-component>
                    <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span>
                </div>
            </div>
            <div class="space-y-6 lg:flex lg:space-y-0 gap-4 *:w-full">
                <!--                rightSide-->
                <div class="space-y-6">
                    <!--                    name-->
                    <h1 class="text-2xl font-black">
                        {{ product.data.name }}
                    </h1>
                    <!--            slider-->
                    <div class="w-full h-60 lg:h-96">
                        <Carousel v-bind="carouselConfig" class="!size-full">
                            <Slide v-for="slide in product.data.images" :key="slide" class="">
                                <div class="carousel__item !size-full">
                                    <img :src="slide.image" alt=""
                                         class="size-full select-none cursor-pointer rounded-xl bg-blue-600">
                                </div>
                            </Slide>
                            <template #addons>
                                <Pagination/>
                            </template>
                        </Carousel>
                    </div>
                    <!--                    size & rate-->
                    <div class="flex gap-4 *:w-full md:*:h-12 *:justify-center *:flex *: *:items-center">
                        <!--                        size-->
                        <div class="productShowItems text-red-600">
                            <strong class="text-defaultColor dark:text-defaultColor5 pl-2">سایز : </strong>
                            {{ product.data.value }}
                        </div>
                        <!--                        rate-->
                        <div
                            class="text-yellow-500 productShowItems">
                            <strong class="text-defaultColor dark:text-defaultColor5">امتیاز: </strong>
                            <div class="flex *:size-4 *:stroke-1 *:stroke-yellow-50 md:*:size-6">
                                <svg-component name="star" class="text-yellow-50"/>
                                <svg-component v-for="item in 4" name="star" class=""/>
                            </div>
                        </div>
                    </div>
                    <!--                    category & brand-->
                    <div class="productShowItems">
                        <div class="w-full flex justify-between px-4">
                            <h2 class="">
                                <strong class="">دسته بندی :</strong>
                                {{ product.data.category.name }}
                            </h2>
                            <div class="h-6 w-0.5 rounded-full bg-defaultColor"></div>
                            <h2 class="">
                                <strong class="">برند :</strong>
                                {{ product.data.brand.name }}
                            </h2>
                        </div>
                    </div>
                    <!--                    price & quantity-->
                    <div class="w-full flex gap-4">
                        <!--                        price-->
                        <div class="productShowItems w-[60%] p-0 overflow-hidden justify-between">
                            <strong class="pr-1">قیمت: </strong>
                            <div class="">
                                <div class="text-green-600">{{ product.data.sale_price }}</div>
                                <div class="text-gray-600 line-through">{{ product.data.price }}</div>
                            </div>
                            <div
                                class="bg-red-600 w-1/4 text-center text-lg font-bold h-full py-3 md:text-2xl md:w-1/5">
                                {{ product.data.off_sale }}%
                            </div>
                        </div>
                        <!--                        quantity-->
                        <div class="productShowItems w-[40%] justify-between px-3 ">
                            <strong>موجودی: </strong>
                            <strong
                                :class="{'text-red-600':product.data.quantity<20, 'text-yellow-500':product.data.quantity<100&&product.data.quantity>20}">{{
                                    product.data.quantity
                                }}</strong>
                        </div>
                    </div>
                </div>
                <!--                leftSide-->
                <div class=""></div>
            </div>

        </div>
        <Footer/>
    </div>
</template>
