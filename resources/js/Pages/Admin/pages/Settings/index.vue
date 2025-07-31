<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AboutSetting from "@/Pages/Admin/pages/Settings/AboutSetting.vue";
import {ref} from "vue";


const props = defineProps({
    settings: Object,
});
const settingName = ref('AboutSetting');

</script>

<template>
    <Layout>
        <div @click="settingName = 'AboutSetting'"
            class="border-b-4 border-x-4 border-adminColor2 px-6 rounded-full shadow-lg shadow-gray-600 text-xl font-bold text-center py-2">
            تنظیمات
        </div>
        <div class="space-y-5 *:m-auto sm:flex sm:gap-5 sm:space-y-0">
            <div class="p-2 border-4 flex gap-5 flex-wrap items-center justify-center border-adminColor2 sm:block rounded-xl sm:space-y-5">
                <div @click="settingName = 'AboutSetting'"
                     class="w-40 flex cursor-pointer items-center border-adminColor2 justify-center border-4 rounded-xl">
                    تنظیمات عمومی
                </div>
                <div @click="settingName = 'navigationSetting'"
                     class="w-40 flex items-center border-adminColor2 justify-center border-4 rounded-xl">
                    تنظیمات منوی ناوبری
                </div>
                <div @click="settingName = 'sliderSetting'"
                     class="w-40 flex items-center border-adminColor2 justify-center border-4 rounded-xl">
                    تنظیمات اسلایدر
                </div>
                <div @click="settingName = 'BannerSetting'"
                     class="w-40 flex items-center border-adminColor2 justify-center border-4 rounded-xl">
                    تنظیمات بنر ها
                </div>
            </div>
            <div class="w-full relative flex justify-center">
                <AboutSetting :is_active="settingName==='AboutSetting'" :settings="settings.AboutSetting.data"/>
            </div>
        </div>
    </Layout>
</template>
