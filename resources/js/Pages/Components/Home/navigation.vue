<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {useDark, useToggle} from "@vueuse/core";
import {ref} from "vue";
import {Link} from '@inertiajs/vue3';
import ConnectModal from "@/Pages/Components/Home/connect-modal.vue";
import {connectUsModalVisibility, modalSet} from "@/Pages/Components/Helper/Helper.js";
import DarkLight from "@/Pages/Components/Home/DarkLight.vue";
const magic_mobile_nav = ref(false);
const info_mobile_nav = ref(false);
const isDark = useDark();
const toggleDark = useToggle(isDark);


document.addEventListener('click', () => {
    magic_mobile_nav.value = false;
    info_mobile_nav.value = false;
    connectUsModalVisibility.value = false;
});

const showConnectModal = () => {
    connectUsModalVisibility.value = !connectUsModalVisibility.value;
}
</script>

<template class="w-full">
    <!--    desktop-->
    <div class="mx-auto sticky top-2 z-10 hidden md:block md:w-full ">
        <div
            class=" w-full px-2 flex justify-between items-center rounded-full z-10 rounded-tl-md bg-defaultColor h-14 text-slate-100 lg:px-6">

            <div class="flex items-center h-full gap-2 lg:gap-4">
                <!--                home-->
                <Link href="/">
                    <div class="header-items">
                        <svg-component name="home" title="صفحه اصلی جوانه سبز" class="size-7"></svg-component>
                        <h1 class="">خانه</h1>
                    </div>
                </Link>
                <div class="separate"></div>
                <!--                products-->
                <div class="relative group">
                    <div class="header-items">
                        <svg-component name="strawberry" class="size-5"></svg-component>
                        <h1 class="">محصولات</h1>
                    </div>
                    <!--                    products-list-->
                    <div class="header-item-lists">
                        <!--                        buds-->
                        <div class="mega-tab-items">
                            <div class="relative overflow-hidden p-4 hover:overflow-visible">
                                <div class="mega-tab-menu-items">
                                    <svg-component name="bud" class="size-6"></svg-component>
                                    <h2 class="">بوته ها</h2>
                                </div>
                                <div class="mega-tab-menu-list top-0">
                                    <div class="text-nowrap w-fit flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6">
                                        <p class=" border-r-4 pr-1 border-defaultColor font-bold">بوته های تابستانه</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 15">توت فرنگی</p>
                                        <p class=" border-r-4 pr-1 border-defaultColor font-bold">بوته های زمستانه</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 21">انگور تابستونی</p>
                                        <p class=" border-r-4 pr-1 border-defaultColor font-bold">بوته های بهاره</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 3">انجیر سیاه </p>
                                        <p class=" border-r-4 pr-1 border-defaultColor font-bold">بوته های پاییزه</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 11">شاه توت</p>
                                    </div>
                                    <div class="w-52 h-full overflow-hidden">
                                        <img src="../../../../../public/images/tootfarangi.jpg"
                                             class="size-full hidden lg:block" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                        Fertilizers-->
                        <div class="mega-tab-items">
                            <div class="relative overflow-hidden p-4 hover:overflow-visible">
                                <div class="mega-tab-menu-items">
                                    <svg-component name="fertilizer" class="size-6"></svg-component>
                                    <h2 class="">کود ها</h2>
                                </div>
                                <div class="mega-tab-menu-list -top-[58px]">
                                    <div class="text-nowrap flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6">
                                        <p class=" border-r-4 pr-1 border-blue-600 font-bold">شیمیایی</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 7">کود سفید</p>
                                        <p class=" border-r-4 pr-1 border-blue-600 font-bold">ارگانیک</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 10">کود سیاه</p>
                                    </div>
                                    <div class="w-72 h-full overflow-hidden">
                                        <img src="../../../../../public/images/fertilizer.jpg"
                                             class="size-full hidden lg:block" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                        more...-->
                        <div class="mega-tab-items">
                            <div class="relative overflow-hidden p-4 hover:overflow-visible">
                                <div class="mega-tab-menu-items">
                                    <svg-component name="up" class="size-6"></svg-component>
                                    <h2 class="">تقویتی</h2>
                                </div>
                                <div class="mega-tab-menu-list -top-[115px]">
                                    <div class="text-nowrap flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6">
                                        <p class=" border-r-4 pr-1 border-blue-600 font-bold">شیمیایی</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 7">کود سفید</p>
                                        <p class=" border-r-4 pr-1 border-blue-600 font-bold">ارگانیک</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 10">کود سیاه</p>
                                    </div>
                                    <div class="w-96 h-full overflow-hidden">
                                        <img src="../../../../../public/images/farm.jpg" class="size-full hidden lg:block"
                                             alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separate"></div>
                <!--                Lesson-->
                <div class="header-items">
                    <svg-component name="book" title="آموزش" class="size-5 lg:size-6"></svg-component>
                    <h1 class="">آموزش ها</h1>
                </div>
                <div class="separate"></div>
                <!--                about us-->
                <Link href="/درباره ما">
                    <div class="header-items">
                        <svg-component name="about" title="درباره جوانه سبز" class="size-5 lg:size-6"></svg-component>
                        <h1 class="">درباره ما</h1>
                    </div>
                </Link>
                <div class="separate"></div>
                <!--                connect with us-->
                <div class="header-items" @click.stop="connectUsModalVisibility=!connectUsModalVisibility">
                    <svg-component name="tell" title="تماس با جوانه سبز" class="size-5 lg:size-6"></svg-component>
                    <h1 class="">تماس با ما</h1>
                </div>
            </div>
            <!--            connection svgs-->
            <div class="flex gap-2 text-defaultColor4 items-center lg:gap-4">
                <!--                telegram-->
                <h2 class="header-connection-svg after:left-[-14px] hover:after:content-['تلگرام']">
                    <svg-component name="telegram" title="جوانه سبز در تلگرام" class="size-8"></svg-component>
                </h2>
                <!--                instagram-->
                <h2 class="header-connection-svg after:left-[-29px] hover:after:content-['اینستاگرام']">
                    <svg-component name="instagram" title="جوانه سبز در اینستاگرام" class="size-8"></svg-component>
                </h2>
                <!--                whatsapp-->
                <h2 class="header-connection-svg after:left-[-19px] hover:after:content-['واتساپ']">
                    <svg-component name="whatsapp" title="جوانه سبز در واتساپ" class="size-7"></svg-component>
                </h2>
            </div>
        </div>
    </div>
    <!--    mobile-->
    <div class="w-full mx-auto fixed bottom-0 px-10 items-center z-20 h-16 bg-opacity-70 text-defaultColor
     rounded-t-full bg-defaultColor flex justify-between md:hidden">
        <!--        darkMode & like & lessons-->
        <div class="home_mobile_navigation_items relative" @click.stop="magic_mobile_nav = !magic_mobile_nav">
            <svg-component name="magic" class="size-[80%] sm:size-10"></svg-component>
            <div
                :class="['absolute w-fit flex gap-3 p-4 items-center -right-12 top-10 duration-500 ease-out opacity-0 text-black' , {'opacity-100 !-top-20': magic_mobile_nav}]">
                <DarkLight></DarkLight>
                <div @click="modalSet('Favorite')" class="bg-slate-700 bg-opacity-50 p-1 text-red-600 rounded-lg fill-none -mt-10 hover:fill-red-900">
                    <svg-component name="like" class="size-7"></svg-component>
                </div>
                <div class="bg-slate-700 bg-opacity-50 p-1 text-blue-600 rounded-lg">
                    <svg-component name="book" class="size-7"></svg-component>
                </div>
            </div>
        </div>
        <!--        buyCart-->
        <div @click="modalSet('BuyCart')" class="home_mobile_navigation_items">
            <svg-component name="cart" title="سبد خرید" class="size-[70%] sm:size-10"></svg-component>
        </div>
        <!--        home-->
        <Link href="/">
            <div class="cursor-pointer flex justify-center items-center duration-500 -mt-10 hover:-translate-y-2">
                <img src="../../../../../public/logo/logo1.png" title="خانه" class="size-20 sm:size-32" alt="">
            </div>
        </Link>
        <!--        products-->
        <div class="home_mobile_navigation_items">
            <svg-component name="strawberry" title="محصولات" class="size-[70%] sm:size-10"></svg-component>
        </div>
        <!--        aboutUs & connectWithUs-->
        <div class="home_mobile_navigation_items relative" @click.stop="info_mobile_nav=!info_mobile_nav">
            <svg-component name="about" class="size-[70%] sm:size-10"></svg-component>
            <div
                :class="['absolute w-fit flex gap-3 p-4 items-center -right-11 top-10 duration-500 ease-out opacity-0 text-black' , {'opacity-100 !-top-20': info_mobile_nav}]">
                <Link href="/درباره ما">
                    <div class="bg-slate-700 bg-opacity-50 p-1 text-gray-200 rounded-lg fill-none hover:fill-red-900">
                        <svg-component name="about" class="size-7"></svg-component>
                    </div>
                </Link>
                <div class="bg-slate-700 bg-opacity-50 p-1 text-defaultColor rounded-lg" @click.stop="connectUsModalVisibility=!connectUsModalVisibility">
                    <svg-component name="tell" class="size-7"></svg-component>
                </div>
            </div>
        </div>
    </div>
    <connect-modal v-if="connectUsModalVisibility"></connect-modal>
</template>

