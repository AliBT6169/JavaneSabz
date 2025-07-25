<script setup>

import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import 'vue3-carousel/carousel.css'
import {Carousel, Slide, Pagination} from 'vue3-carousel';
import Navigation from "@/Pages/Components/Home/navigation.vue";
import Product from "@/Pages/Components/Home/Product.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {ref} from "vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import Comments from "@/Pages/Components/Home/Comments.vue";

const carouselConfig = {
    itemsToShow: 1,
    autoplay: 3000,
    dir: 'rtl',
    gap: 1,
    wrapAround: true,
    breakpointMode: 'carousel',
}
const props = defineProps(["productData"]);
useIndexStore().setProductData(props.productData);
const product = ref(useIndexStore().ProductShowData);
const likeUnLike = async () => {
    const res = await ref(useAuthStore().likeOrUnLike(product.value.data.id, product.value.data.is_liked));
    product.value.data.is_liked = await res.value;
}
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Header/>
        <Navigation/>
        <div class="w-full space-y-6 text-defaultColor dark:text-defaultColor5 md:text-xl">
            <!--        page location-->
            <div class="w-full flex">
                <div class="flex items-center w-fit gap-2">
                    <Link href="/">
                <span
                    class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                    </Link>
                    <svg-component name="next" class="size-3"></svg-component>
                    <Link href="#">
                        <span
                            class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">{{
                                product.data.name
                            }}</span>

                    </Link>
                </div>
            </div>
            <div class="space-y-6 lg:flex lg:space-y-0 gap-4 *:w-full">
                <!--                rightSide-->
                <div class="space-y-6">
                    <!--                    name-->
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-black">
                            {{ product.data.name }}
                        </h1>
                        <div class="flex gap-2 items-center *:cursor-pointer">
                            <div
                                class="p-1.5 rounded-full bg-defaultColor5/40 border border-current duration-500 hover:bg-defaultColor5/70
                                 dark:bg-defaultColor/50 dark:hover:bg-defaultColor">
                                <svg-component name="cart" class="size-6 md:size-8"
                                               @click="useAuthStore().addToCart(product.data.id)"></svg-component>
                            </div>
                            <div
                                class="p-1.5 rounded-full bg-red-600/30 border border-red-600 duration-500 hover:bg-red-600/60">
                                <svg-component name="like" @click="likeUnLike()"
                                               class="size-6 md:size-8 text-red-600 fill-none"
                                               :class="{'fill-red-600':product.data.is_liked}"></svg-component>
                            </div>
                        </div>
                    </div>
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
                <div class="space-y-6">
                    <div class="rounded-xl border border-defaultColor lg:mt-[4.5rem]">
                        <div class="productShowItems justify-center rounded-b-none py-2">
                            اطلاعات محصول
                        </div>
                        <div class="p-4">
                            {{ product.data.description }}
                        </div>
                    </div>
                    <div class="productShowItems flex gap-6 justify-between py-4 *:w-full">
                        <h3 class="">
                            <svg-component name="esalat"
                                           class="size-8 inline text-defaultColor/70 dark:text-defaultColor5"></svg-component>
                            تضمین اصالت کالا
                        </h3>
                        <h3 class="">
                            <svg-component name="garantie"
                                           class="size-8 inline text-defaultColor/70 stroke-1 stroke-black dark:text-defaultColor5"></svg-component>
                            گارانتی 7 روز بازگشت کالا
                        </h3>
                    </div>
                </div>
            </div>
<!--            comments-->
            <!--                    same Products-->
            <div class="rounded-t-xl border border-current">
                <div class="w-full text-center py-2 bg-defaultColor/80 text-defaultColor5 rounded-t-xl">محصولات مشابه:
                </div>
                <div class="p-5 overflow-x-scroll">
                    <div class="w-fit flex gap-8 items-center">
                        <product v-for="item in product.data.sameProducts" :product="item"></product>
                    </div>
                </div>
            </div>
            <Comments :product_id="product.data.id" :comments="product.data.comments"></Comments>
        </div>
        <Footer/>
    </div>
</template>
