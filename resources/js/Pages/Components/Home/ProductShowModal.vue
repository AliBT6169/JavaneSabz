<script setup>
import {data} from "autoprefixer";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {Carousel, Pagination, Slide} from "vue3-carousel";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {ref} from "vue";

const props = defineProps({
    productData: null,
});

const carouselConfig = {
    itemsToShow: 1,
    autoplay: 3000,
    dir: 'rtl',
    gap: 1,
    wrapAround: true,
    breakpointMode: 'carousel',
}
const likeUnLike = async () => {
    const res = await ref(useAuthStore().likeOrUnLike(props.productData.id, props.productData.is_liked));
    props.productData.is_liked = await res.value;
}
</script>

<template>
        <div class="p-2 size-3/4 bg-defaultColor5 rounded-xl dark:bg-defaultColor">

        <div class="size-full overflow-scroll space-y-6 lg:flex lg:space-y-0 gap-4">
            <!--                rightSide-->
            <div class="space-y-6">
                <!--                    name-->
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-black">
                        {{ productData.name }}
                    </h1>
                    <div class="flex gap-2 items-center *:cursor-pointer">
                        <div
                            class="p-1.5 rounded-full bg-defaultColor5/40 border border-current duration-500 hover:bg-defaultColor5/70
                                 dark:bg-defaultColor/50 dark:hover:bg-defaultColor">
                            <svg-component name="cart" class="size-6 md:size-8"
                                           @click="useAuthStore().addToCart(productData.id)"></svg-component>
                        </div>
                        <div
                            class="p-1.5 rounded-full bg-red-600/30 border border-red-600 duration-500 hover:bg-red-600/60">
                            <svg-component name="like" @click="likeUnLike()"
                                           class="size-6 md:size-8 text-red-600 fill-none"
                                           :class="{'fill-red-600':productData.is_liked}"></svg-component>
                        </div>
                    </div>
                </div>
                <!--            slider-->
                <div class="w-full h-60 lg:h-96">
                    <Carousel v-bind="carouselConfig" class="!size-full">
                        <Slide v-for="slide in productData.images" :key="slide" class="">
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
                        {{ productData.value }}
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
                            {{ productData.category.name }}
                        </h2>
                        <div class="h-6 w-0.5 rounded-full bg-defaultColor"></div>
                        <h2 class="">
                            <strong class="">برند :</strong>
                            {{ productData.brand.name }}
                        </h2>
                    </div>
                </div>
                <!--                    price & quantity-->
                <div class="w-full flex gap-4">
                    <!--                        price-->
                    <div class="productShowItems w-[60%] p-0 overflow-hidden justify-between">
                        <strong class="pr-1">قیمت: </strong>
                        <div class="">
                            <div class="text-green-600">{{ productData.sale_price }}</div>
                            <div class="text-gray-600 line-through">{{ productData.price }}</div>
                        </div>
                        <div
                            class="bg-red-600 w-1/4 text-center text-lg font-bold h-full py-3 md:text-2xl md:w-1/5">
                            {{ productData.off_sale }}%
                        </div>
                    </div>
                    <!--                        quantity-->
                    <div class="productShowItems w-[40%] justify-between px-3 ">
                        <strong>موجودی: </strong>
                        <strong
                            :class="{'text-red-600':productData.quantity<20, 'text-yellow-500':productData.quantity<100&&productData.quantity>20}">{{
                                productData.quantity
                            }}</strong>
                    </div>
                </div>
            </div>
            <!--                leftSide-->
            <div class="space-y-6 max-w-full">
                <div class="rounded-xl border border-defaultColor lg:mt-[4.5rem]">
                    <div class="productShowItems justify-center rounded-b-none py-2">
                        اطلاعات محصول
                    </div>
                    <div class="p-4 text-wrap">
                        {{ productData.description }}
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
    </div>
</template>
