<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from '@inertiajs/vue3'
import IndexLyout from "@/Pages/IndexLyout.vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";

const props = defineProps({
    info: Object,
});
const setting = useIndexStore().Settings;
</script>
<template>
    <IndexLyout>
        <!--        page location-->
        <div class="w-full flex">
            <div class="flex items-center w-fit gap-2 px-4">
                <Link href="/">
                <span
                    class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">خانه </span>
                </Link>
                <svg-component name="next" class="size-3"></svg-component>
                <span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span>
            </div>
        </div>
        <div class="flex flex-col mx-auto items-center w-full gap-5 p-6 rounded-xl border-2 border-defaultColor">
            <span
                class="w-full p-5 rounded-2xl bg-gradient-to-b from-defaultColor2 to-defaultColor5 2xl:p-10 dark:from-50%">{{
                    info.description
                }}</span>
            <div class="flex w-full justify-center gap-4 mt-4 flex-col md:flex-row">
                <div
                    class="relative w-full h-96 flex justify-center items-center rounded-xl p-5 bg-defaultColor5 mx-auto overflow-hidden dark:bg-defaultColor7">
                    <img :src="info.store_image" alt=""
                         class="size-full rounded-2xl">
                    <div
                        class="absolute bottom-8 p-2 rounded-lg bg-defaultColor5 dark:bg-defaultColor7 dark:text-white animate-bounce">
                        فروشگاه {{ info.store_name }} از نمای نزدیک
                    </div>
                </div>
                <div
                    class="relative w-full h-96 flex justify-center items-center rounded-xl p-5 bg-defaultColor5 mx-auto overflow-hidden dark:bg-defaultColor7">
                    <img :src="info.owner_image" alt="" class="size-full rounded-2xl">
                    <div
                        class="absolute bottom-8 p-2 rounded-lg bg-defaultColor5 dark:bg-defaultColor7 dark:text-white animate-bounce">
                        مدیریت : {{ info.owner_name }}
                    </div>
                </div>
            </div>
            <div
                class="flex flex-col w-full items-start gap-10 justify-between mt-6 rounded-xl border-2 border-defaultColor border-b-0 py-4 lg:flex-row">
                <div class="flex w-full flex-col items-center gap-2 ">
                    <div class="text-xl font-black">پل های ارتباطی:</div>
                    <div class="flex justify-center gap-2">
                        <a :href="'t.me:'+setting.settings.data.telegram" class="">
                            <svg-component name="telegram"
                                           class="size-11 cursor-pointer duration-300 hover:-translate-y-1"></svg-component>
                        </a>
                        <a :href="'wa.me:'+setting.settings.data.whatsapp" class="">
                            <svg-component name="whatsapp"
                                           class="size-10 cursor-pointer duration-300 hover:-translate-y-1"></svg-component>
                        </a>
                        <a :href="'instagram.com/'+setting.settings.data.instagram" class="">
                            <svg-component name="instagram"
                                           class="size-11 cursor-pointer duration-300 hover:-translate-y-1 -mt-0.5"></svg-component>
                        </a>
                        <a :href="'tel:'+setting.settings.data.phone" class="">
                            <svg-component name="tell"
                                           class="size-10 cursor-pointer duration-300 hover:-translate-y-1"></svg-component>
                        </a>
                    </div>
                </div>
                <div class="flex w-full flex-col justify-center items-center">
                    <span class="font-black text-xl">نشانی:</span>
                    <span class="w-60">{{ setting.settings.data.address }}</span>
                </div>
                <div class="flex flex-col w-full items-center justify-center gap2">
                    <div class="font-bold text-xl">موقعیت نقشه:</div>
                    <div class="size-fit overflow-hidden rounded-lg border-2 border-defaultColor5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d205.92511102483456!2d52.77588788202066!3d36.650352865990975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f857d39956460cb%3A0xd35d50893e1ab96f!2z2LPZhdmI2YUg2qnYtNin2YjYsdiy24wg2KzZiNin2YbZhyDYs9io2LIg2LTZhdin2YQ!5e0!3m2!1sen!2s!4v1736097896290!5m2!1sen!2s"
                            width="200" height="150" style="border: none" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </IndexLyout>
</template>
