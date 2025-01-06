<script setup>

import SvgComponent from "@/Components/svg-component.vue";
</script>

<template>
    <div class="mx-auto sticky top-2 z-10">
        <div
            class=" w-full px-6 flex justify-between items-center rounded-full z-10 rounded-tl-md bg-defaultColor h-14 text-slate-100">

            <div class="flex items-center h-full gap-4">
                <!--                home-->
                <div class="header-items">
                    <svg-component name="home" title="صفحه اصلی جوانه سبز" class="size-7"></svg-component>
                    <h1 class="">خانه</h1>
                </div>
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
                                    <div class="text-nowrap flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6">
                                        <p class=" border-r-4 pr-1 border-defaultColor font-bold">بوته های تابستانه</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 15">توت فرنگی</p>
                                        <p class=" border-r-4 pr-1 border-defaultColor font-bold">بوته های زمستانه</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 5">توت فرنگی</p>
                                    </div>
                                    <div class="w-72 h-full overflow-hidden">
                                        <img src="../../../../public/images/tootfarangi.jpg" class="size-full" alt="">
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
                                        <img src="../../../../public/images/fertilizer.jpg" class="size-full" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--                        more...-->
                        <div class="mega-tab-items">
                            <div class="relative overflow-hidden p-4 hover:overflow-visible">
                                <div class="mega-tab-menu-items">
                                    <svg-component name="up " class="size-6"></svg-component>
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
                                        <img src="../../../../public/images/farm.jpg" class="size-full" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="separate"></div>
                <!--                Lesson-->
                <div class="header-items">
                    <svg-component name="book" title="آموزش" class="size-6"></svg-component>
                    <h1 class="">آموزش ها</h1>
                </div>
                <div class="separate"></div>
                <!--                about us-->
                <div class="header-items">
                    <svg-component name="about" title="درباره جوانه سبز" class="size-6"></svg-component>
                    <h1 class="">درباره ما</h1>
                </div>
                <div class="separate"></div>
                <!--                connect with us-->
                <div class="header-items">
                    <svg-component name="tell" title="تماس با جوانه سبز" class="size-6"></svg-component>
                    <h1 class="">تماس با ما</h1>
                </div>
            </div>
            <!--            connection svgs-->
            <div class="flex gap-4 text-defaultColor4 items-center">
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
</template>

