<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import {Link} from '@inertiajs/vue3'
import {ref} from "vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";
import ProductShowModal from "@/Pages/Components/Home/ProductShowModal.vue";

const props = defineProps(["product", "special"]);
const productModal = ref(false);
const productModalData = ref();
const likeUnLike = async () => {
    const res = await ref(useAuthStore().likeOrUnLike(props.product.id, props.product.is_liked));
    props.product.is_liked = await res.value;
}
const productShow = async () => {
    const data = ref(await useIndexStore().productShow(props.product.id));
    if (data.value.status === 200) {
        productModal.value = true;
        productModalData.value = data.value.data
    }
}
</script>

<template>
    <div
        class="relative !w-60 group overflow-hidden border border-white rounded-lg shadow-sm hover:shadow-md
        hover:shadow-slate-500 duration-500 cursor-pointer bg-defaultColor6 pb-6 space-y-3 hover3D-animation
         items-center dark:bg-defaultColor7 dark:shadow-defaultColor dark:border-gray-700 md:text-base"
        :class="{'shadow-xl !shadow-red-500':product.is_liked}">
        <Link class="block" :href="route('ProductShow',{id:product.id,slug:product.slug})">
            <img loading="lazy" :src="product.image" alt="" @dragstart.prevent class="w-60 h-40">
        </Link>
        <!--        name-->
        <div class="flex px-4 justify-center w-full items-center">
            <h3 class="w-28 text-center text-nowrap">{{
                    product.name.substring(0,15) + (product.value === undefined ? '' : ' : ' + product.value)
                }}</h3>
        </div>
        <!--        price & buy cart-->
        <div class="w-full px-4 flex lg:justify-between items-center flex-col gap-2">
            <div v-if="product.price" class="text-defaultColor dark:text-defaultColor5">
                <div v-if="product.off_sale>0" class="">
                    <div class="">{{
                            product.price.toLocaleString('fa-IR') + 'تومان '
                        }}
                    </div>
                    <div class="flex gap-1 items-center">
                        <div class="text-sm text-gray-500 line-through">{{ product.old_price.toLocaleString('en-US') }}</div>
                        <div class="text-red-500 p-0.5 font-bold border border-red-500/50 bg-red-500/20 rounded-lg">{{ product.off_sale + '%'}}</div>
                    </div>
                </div>
                <div v-else class="">{{
                        product.price.toLocaleString('fa-IR') + 'تومان '
                    }}
                </div>
            </div>
            <div v-else class="bg-defaultColor5 text-defaultColor7 rounded-full flex items-center p-1
             dark:bg-defaultColor dark:text-defaultColor5 hover:bg-opacity-50 hover:-translate-y-1 duration-500">مشاهده
                <svg-component name="show" class="size-5"/>
            </div>
            <span
                class="flex justify-between items-center w-full lg:w-fit lg:block">
                <div @click="useAuthStore().addToCart(product.id)"
                     class="flex items-center gap-1 px-3 py-1 duration-300 rounded-xl border border-gray-500/50 hover:bg-gray-500/20">
                    <div class="">سبد خرید</div>
                    <svg-component name="cart" class="size-7"/>

                </div>
                <svg-component :title="product.is_liked?'حذف از علاقه مندی':'افزودن به علاقه مندی'" name="like"
                               @click="likeUnLike"
                               class="size-7 hover:fill-red-500 fill-transparent text-red-500 duration-500 dark:fill-defaultColor7
                               dark:hover:fill-red-900 dark:text-red-900 lg:hidden"
                               :class="{'!fill-red-500':product.is_liked}"/>
            <svg-component title="مشاهده محصول" name="show" @click="productShow"
                           class="size-7 hover:text-defaultColor duration-500 lg:hidden"/>
            </span>
        </div>
        <!--        like & show-->
        <div
            class="absolute hidden -top-3 bg-defaultColor4/50 p-2 -left-10 flex-col duration-500 items-center
             group-hover:left-0 rounded-lg dark:bg-defaultColor7/50 lg:flex">
            <svg-component :title="product.is_liked?'حذف از علاقه مندی':'افزودن به علاقه مندی'" name="like"
                           @click="likeUnLike"
                           class="size-6 hover:fill-red-500 fill-transparent text-red-500 duration-500
                           dark:fill-transparent dark:hover:fill-red-900 dark:text-red-900"
                           :class="{'!fill-red-500':product.is_liked}"></svg-component>
            <svg-component title="مشاهده محصول" name="show"
                           @click="productShow"
                           class="size-6 hover:text-defaultColor duration-500"/>
        </div>
        <div class="absolute -top-3 right-0 py-5 rounded-b-full bg-red-600 text-slate-200 dark:bg-red-900"
             v-if="product.is_special===true">
            <p class="-rotate-90 mr-0.5">ویژه</p>
        </div>

    </div>
    <div
        class="fixed invisible z-50 opacity-0 duration-500 top-0 left-0 flex justify-center items-center w-screen h-screen bg-gray-800/30"
        :class="{'!visible !opacity-100':productModal}"
        @click.self="productModal = false">
        <product-show-modal v-if="productModal" :product-data="productModalData"/>
    </div>
</template>
