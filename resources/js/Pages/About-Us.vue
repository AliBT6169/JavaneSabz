<script setup>

import Navigation from "@/Pages/Components/navigation.vue";
import Header from "@/Pages/Parts/Header.vue";
import Footer from "@/Pages/Parts/Footer.vue";
import SvgComponent from "@/Components/svg-component.vue";
</script>

<template>
    <div class="mx-auto flex flex-col gap-10 items-center w-[20rem]
        sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]">
        <Header></Header>
        <Navigation></Navigation>
        <!--        page location-->
        <div class="w-full flex">
            <div class="flex items-center w-fit gap-2 px-4">
                <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                <svg-component name="next" class="size-3"></svg-component>
                <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span>
            </div>
        </div>
        <div class="flex flex-col mx-auto items-center w-full">
            <span class="w-full p-5 rounded-2xl bg-gradient-to-b from-defaultColor2 to-defaultColor5 2xl:p-10 dark:from-50%">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و
                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و
                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده،
                شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی
                الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و
                دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای
                اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.لورم ایپسوم متن ساختگی
                با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و
                مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف
                بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و
                متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و
                فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه
                راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات
                پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
            </span>
            <div class="flex w-full justify-center gap-4 mt-4 flex-col md:flex-row">
                <div class="relative w-full h-96 flex justify-center items-center rounded-xl p-5 bg-defaultColor5 mx-auto overflow-hidden dark:bg-defaultColor7">
                    <img src="../../../public/images/about-us/mojtaba.jpg" alt="" class="size-full rounded-2xl">
                    <div class="absolute bottom-8 p-2 rounded-lg bg-defaultColor5 dark:bg-defaultColor7 dark:text-white animate-bounce">فروشگاه جوانه سبز از نمای نزدیک</div>
                </div>
                <div class="relative w-full h-96 flex justify-center items-center rounded-xl p-5 bg-defaultColor5 mx-auto overflow-hidden dark:bg-defaultColor7">
                    <img src="../../../public/images/about-us/owner.jpg" alt="" class="size-full rounded-2xl">
                    <div class="absolute bottom-8 p-2 rounded-lg bg-defaultColor5 dark:bg-defaultColor7 dark:text-white animate-bounce">مدیریت : مجتبی میرقربانی</div>
                </div>
            </div>
        </div>
        <Footer></Footer>
    </div>
</template>
