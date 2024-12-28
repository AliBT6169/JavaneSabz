<script setup>

import SvgComponent from "@/Components/svg-component.vue";

</script>

<template>
    <header class="px-20 mx-auto">
        <div class="w-full flex justify-between items-center">
            <!--            icon-->
            <div class="flex items-center gap-1 justify-center">
                <img src="../../../../public/logo/logo1.png" class="w-24 h10" alt="">
                <div class="w-2 h-8 border-gray-300 border-r-2"></div>
                <div class="flex gap-1 flex-col">
                    <div class="font-[1000] text-[1rem] ">فروشگاه آنلاین شاهان</div>
                    <div class=" text-slate-500 text-xs">فروشگاهی برای همه سلیقه ها</div>
                </div>
            </div>
            <!--            search box-->
            <div class="w-[30rem] -mt-10">
                <div class="absolute">
                    <input type="text"
                           class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor text-[0.65rem] w-[30rem] h-10 rounded-2xl bg-gray-50 border-gray-200 "
                           placeholder="جستجوی محصول">
                    <div class=" relative -top-[29px] right-[93%] cursor-pointer">
                        <svg fill="#000000" viewBox="0 0 56 56" class=" size-5">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M 23.9570 41.7695 C 27.8476 41.7695 31.4804 40.5039 34.4336 38.3945 L 45.5429 49.5039 C 46.0585 50.0195 46.7382 50.2774 47.4414 50.2774 C 48.9648 50.2774 50.0664 49.1055 50.0664 47.6055 C 50.0664 46.9023 49.8322 46.2461 49.3162 45.7305 L 38.2773 34.6679 C 40.5976 31.6211 41.9804 27.8476 41.9804 23.7461 C 41.9804 13.8320 33.8710 5.7226 23.9570 5.7226 C 14.0195 5.7226 5.9336 13.8320 5.9336 23.7461 C 5.9336 33.6601 14.0195 41.7695 23.9570 41.7695 Z M 23.9570 37.8789 C 16.1992 37.8789 9.8242 31.4805 9.8242 23.7461 C 9.8242 16.0117 16.1992 9.6133 23.9570 9.6133 C 31.6914 9.6133 38.0898 16.0117 38.0898 23.7461 C 38.0898 31.4805 31.6914 37.8789 23.9570 37.8789 Z"></path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <!--                        buy cart-->
            <div
                class="w-36 mr-6 shine_animation h-[2.2rem] rounded-bl-sm rounded-3xl bg-defaultColor flex shadow-sm gap-2 justify-center items-center">
                <svg viewBox="0 0 16 16" class="fill-white stroke-white stroke-[0.75] size-4    ">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z"></path>
                    </g>
                </svg>
                <div class="text-xs text-white">سبد خرید</div>
                <div class="size-4 vazir-Light flex items-center justify-center bg-white rounded-2xl">
                    <div class="flex items-center h-full mt-1">0</div>
                </div>
            </div>
            <!--            login and register-->
            <div
                class="-mr-4 hover:bg-defaultColor group hover:text-white transition-colors duration-[400ms] text-sm flex gap-2 bg-white rounded-lg items-center justify-center border shadow-lg h-9 border-slate-300 px-4 shine_animation">
                <svg viewBox="0 0 56 56"
                     class=" group-hover:fill-white transition-colors duration-300 size-5 fill-defaultColor">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M 28.0117 27.3672 C 33.0508 27.3672 37.3867 22.8672 37.3867 17.0078 C 37.3867 11.2187 33.0274 6.9297 28.0117 6.9297 C 22.9961 6.9297 18.6367 11.3125 18.6367 17.0547 C 18.6367 22.8672 22.9961 27.3672 28.0117 27.3672 Z M 13.2930 49.0703 L 42.7305 49.0703 C 46.4101 49.0703 47.7226 48.0156 47.7226 45.9531 C 47.7226 39.9062 40.1523 31.5625 28.0117 31.5625 C 15.8477 31.5625 8.2774 39.9062 8.2774 45.9531 C 8.2774 48.0156 9.5898 49.0703 13.2930 49.0703 Z"></path>
                    </g>
                </svg>
                <div class="">ورود / ثبت نام</div>
            </div>
            <div class="flex gap-2 items-center">
                <!--            like-->
                <div
                    class=" size-9 hover:bg-[#FF8A665E] transition-colors duration-[400ms] shine_animation bg-[#f6dfda] flex justify-center items-center rounded-xl ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="#f54f19"
                         class=" size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                    </svg>
                </div>
                <!--            dark and light mode-->
                <div class="size-9 flex items-center justify-center hover:bg-slate-400 transition-all rounded-xl bg-slate-300 border-slate-800 shine_animation cursor-pointer">
                    <svg-component name="moon2" class="size-6" title="دارک مود"></svg-component>
                </div>
            </div>
        </div>
        <!--        navigation-->
        <div class="w-full px-6 flex justify-between rounded-full rounded-tl-md bg-defaultColor h-14">
            <div class="flex items-center gap-4">
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
                                        <p class=" border-r-4 pr-1 border-blue-600 font-bold">بوته های تابستانه</p>
                                        <p class="mega-tab-menu-list-items" v-for="index in 15">توت فرنگی</p>
                                        <p class=" border-r-4 pr-1 border-blue-600 font-bold">بوته های زمستانه</p>
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
            </div>
        </div>
    </header>
</template>
