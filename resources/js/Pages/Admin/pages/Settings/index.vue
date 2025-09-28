<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AboutSetting from "@/Pages/Admin/pages/Settings/AboutSetting.vue";
import {ref} from "vue";
import AboutUsSetting from "@/Pages/Admin/pages/Settings/AboutUsSetting.vue";
import NavSetting from "@/Pages/Admin/pages/Settings/NavSetting.vue";
import BestBrands from "@/Pages/Admin/pages/Settings/bestBrands.vue";
import BannersSetting from "@/Pages/Admin/pages/Settings/BannersSetting.vue";
import SliderSettings from "@/Pages/Admin/pages/Settings/SliderSettings.vue";
import PasswoarsChange from "@/Pages/Admin/pages/Settings/PasswoarsChange.vue";


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
            <div
                class="p-2 border-4 flex gap-5 flex-wrap items-center justify-center border-adminColor2 sm:block rounded-xl sm:space-y-5">
                <div @click="settingName = 'AboutSetting'"
                     class="adminSettingSidebarItem">
                    تنظیمات عمومی
                </div>
                <div @click="settingName = 'AboutUsSetting'"
                     class="adminSettingSidebarItem">
                    تنظیمات درباره ما
                </div>
                <div @click="settingName = 'navigationSetting'"
                     class="adminSettingSidebarItem">
                    تنظیمات منوی ناوبری
                </div>
                <div @click="settingName = 'bestBrands'"
                     class="adminSettingSidebarItem">
                    تنظیمات بهترین برند
                </div>
                <div @click="settingName = 'sliderSetting'"
                     class="adminSettingSidebarItem">
                    تنظیمات اسلایدر
                </div>
                <div @click="settingName = 'bannerSetting'"
                     class="adminSettingSidebarItem">
                    تنظیمات بنر ها
                </div>
                <div @click="settingName = 'PasswordChange'"
                     class="adminSettingSidebarItem">
                    تغییر رمز عبور
                </div>
            </div>
            <div class="w-full relative flex justify-center">
                <AboutSetting :is_active="settingName==='AboutSetting'" :settings="settings.AboutSetting.data"/>
                <AboutUsSetting :is_active="settingName==='AboutUsSetting'" :settings="settings.AboutUsSetting"/>
                <NavSetting :is_active="settingName==='navigationSetting'" :settings="settings.NavSetting"/>
                <best-brands :is_active="settingName==='bestBrands'" :settings="settings.BestBrandsSettings.data"/>
                <BannersSetting :is_active="settingName==='bannerSetting'" :settings="settings.BannersSettings.data"/>
                <SliderSettings :is_active="settingName==='sliderSetting'" :settings="settings.SliderSettings.data"/>
                <PasswoarsChange :is_active="settingName==='PasswordChange'"/>
            </div>
        </div>
    </Layout>
</template>
