<script setup>

import SvgComponent from "@/Components/svg-component.vue";

</script>

<template>
    <header class="mx-auto">
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
                    <div class="fill-none text-[#f54f19]">
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
    </header>
</template>
