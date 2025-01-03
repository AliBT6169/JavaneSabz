<script setup>

import SvgComponent from "@/Components/svg-component.vue";

</script>

<template>
    <header class="px-20 mx-auto">
        <!--        header-->
        <div class="w-full flex justify-between items-center">
            <!--            icon-->
            <div class="flex items-center gap-1 justify-center">
                <img src="../../../../public/logo/logo1.png" class="w-24 h10" alt="">
                <div class="w-2 h-8 border-gray-300 border-r-2"></div>
                <div class="flex gap-1 flex-col">
                    <div class="font-[1000] text-[1rem] ">فروشگاه محصولات کشاورزی جوانه سبز</div>
                    <div class=" text-slate-500 text-xs">دوست مهربان کشاورز ها</div>
                </div>
            </div>
            <!--            search box-->
            <div class="w-[30rem] -mt-10">
                <div class="absolute">
                    <input type="text"
                           class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor text-[0.65rem] w-[30rem] h-10 rounded-2xl bg-gray-50 border-gray-200 "
                           placeholder="جستجوی محصول">
                    <div class=" relative -top-[29px] right-[93%] cursor-pointer">
                        <svg-component name="search" class="size-5"></svg-component>
                    </div>
                </div>
            </div>
            <!--                        buy cart-->
            <div
                class="w-36 shine_animation h-[2.2rem] rounded-bl-sm rounded-3xl bg-defaultColor flex shadow-sm gap-2 justify-center items-center">
                <div class="text-defaultColor4">
                    <svg-component name="cart" class="size-5"></svg-component>
                </div>
                <div class="text-xs text-white">سبد خرید</div>
                <div class="size-4 flex items-center justify-center bg-white rounded-2xl">
                    <div class="flex items-center h-full mt-1">0</div>
                </div>
            </div>
            <!--            login and register-->
            <div
                class=" hover:bg-defaultColor group hover:text-white transition-colors duration-[400ms] text-sm flex gap-2 bg-white rounded-lg items-center justify-center border shadow-lg h-9 border-slate-300 px-4 shine_animation">
                <svg-component name="person" class="size-5"></svg-component>
                <div class="">ورود / ثبت نام</div>
            </div>
            <div class="flex gap-2 items-center">
                <!--            like-->
                <div
                    class=" size-9 hover:bg-[#FF8A665E] transition-colors duration-[400ms] shine_animation bg-[#f6dfda] flex justify-center items-center rounded-xl ">
                    <div class="text-[#f54f19]">
                        <svg-component name="like" class="size-6"></svg-component>
                    </div>
                </div>
                <!--            dark and light mode-->
                <div
                    class="size-9 flex items-center justify-center hover:bg-slate-400 transition-all rounded-xl bg-slate-300 border-slate-800 shine_animation cursor-pointer">
                    <svg-component name="moon2" class="size-6" title="دارک مود"></svg-component>
                </div>
            </div>
        </div>
        <!--        navigation-->
        <div
            class="w-full px-6 flex justify-between items-center rounded-full relative z-10 rounded-tl-md bg-defaultColor h-14">

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
                                    <svg-component name="fertilizer" class="size-6"></svg-component>
                                    <h2 class="">کود ها</h2>
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
    </header>
</template>
