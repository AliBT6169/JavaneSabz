<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {onMounted, ref} from "vue";

const props = defineProps({
    settings: Object,
})

const siteDomain = ref();
onMounted(() => {
    const siteLocation = window.location.hostname.split(".");
    siteDomain.value = siteLocation.pop();
})
</script>

<template>
    <div
        class="p-2 bg-defaultColor7 w-full flex justify-center items-center rounded-t-[8rem] overflow-hidden">
        <div
            class="pb-40 w-full md:pb-0 items-center md:items-start md:justify-around flex flex-col text-white md:flex-row">
            <div class="flex flex-col gap-2 h-full">
                <div
                    class="flex duration-300 items-center cursor-pointer gap-2 border-b-2 border-defaultColor5">
                    <img :src="settings?.icon" alt="جوانه سبز" class="size-20">
                    <h3 class="text-2xl font-black text-defaultColor5">جوانه سبز</h3>
                </div>
                <p class="w-60">
                    {{ settings?.about }}
                </p>
            </div>
            <div class="flex flex-col gap-2 h-full">
                <div class="flex border-b-2 border-defaultColor5 justify-center items-center">
                    <div class="size-20 flex items-center">
                        <svg-component name="about" class="size-8"></svg-component>
                    </div>
                    <p class="text-xl translate-x-10 font-black">اطلاعات</p>
                </div>
                <Link href="/درباره ما"
                      class="flex duration-300 items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">
                    <svg-component name="about" class="size-5"></svg-component>
                    <h3 class="">درباره ما</h3>
                </Link>
                <div
                    class="flex duration-300 items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">
                    <a rel="stylesheet" :href="'tel:'+settings?.phone">
                        <svg-component name="tell" title="09123456789" class="size-5"></svg-component>
                    </a>
                    <h3 class="">تماس با ما</h3>
                </div>
                <div class="flex flex-col gap-3">
                    <div
                        class="flex duration-300 items-center gap-2">
                        <svg-component name="connection" class="size-5"></svg-component>
                        <h3 class="">پل های ارتباطی :</h3>
                    </div>
                    <div class="flex gap-2">
                        <a :href="'https://t.me/'+settings?.telegram">
                            <svg-component name="telegram" class="footer-connection-svg size-[30px]"/>
                        </a>
                        <a :href="'https://instagram.com//'+settings?.instagram">
                            <svg-component name="instagram" class="footer-connection-svg size-[30px]"/>
                        </a>
                        <a :href="'https://wa.me/'+settings?.whatsapp">
                            <svg-component name="whatsapp" class="footer-connection-svg size-7"/>
                        </a>
                        <a :href="'tell:'+settings?.phone">
                            <svg-component name="tell" class="footer-connection-svg size-[30px]"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-2 h-full">
                <div class="flex border-b-2 border-defaultColor5 justify-center items-center">
                    <div class="size-20 flex items-center">
                        <svg-component name="location" class="size-8"></svg-component>
                    </div>
                    <p class="text-xl translate-x-10 font-black">موقعیت مکانی</p>
                </div>
                <div class="">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d205.92511102483456!2d52.77588788202066!3d36.650352865990975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f857d39956460cb%3A0xd35d50893e1ab96f!2z2LPZhdmI2YUg2qnYtNin2YjYsdiy24wg2KzZiNin2YbZhyDYs9io2LIg2LTZhdin2YQ!5e0!3m2!1sen!2s!4v1736097896290!5m2!1sen!2s"
                        width="200" height="150" style="border: none" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="flex flex-col gap-2 h-full">
                <div class="flex border-b-2 border-defaultColor5 justify-center items-center">
                    <div class="size-20 flex items-center">
                    </div>
                    <p class="text-xl translate-x-10 font-black">اعتماد</p>
                </div>
                <div class="">

                    <a v-if="siteDomain === 'com'" referrerpolicy='origin' target='_blank'
                       href='https://trustseal.enamad.ir/?id=684132&Code=Wt5jPY4YRGXtd0eqqvH07xKke2ZQkncZ'><img
                        referrerpolicy='origin'
                        src='https://trustseal.enamad.ir/logo.aspx?id=684132&Code=Wt5jPY4YRGXtd0eqqvH07xKke2ZQkncZ'
                        alt='' style='cursor:pointer' code='Wt5jPY4YRGXtd0eqqvH07xKke2ZQkncZ'></a>

                    <a v-else referrerpolicy='origin' target='_blank'
                       href='https://trustseal.enamad.ir/?id=686725&Code=1stzOUDUUtzTIfIzsaXxeSKkT18cPmlb'><img
                        referrerpolicy='origin'
                        src='https://trustseal.enamad.ir/logo.aspx?id=686725&Code=1stzOUDUUtzTIfIzsaXxeSKkT18cPmlb'
                        alt='' style='cursor:pointer' code='1stzOUDUUtzTIfIzsaXxeSKkT18cPmlb'></a>
                </div>
            </div>
        </div>
    </div>
</template>
