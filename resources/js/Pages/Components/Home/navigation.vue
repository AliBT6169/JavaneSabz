<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import {useDark, useToggle} from "@vueuse/core";
import {onMounted, ref} from "vue";
import {Link} from '@inertiajs/vue3';
import ConnectModal from "@/Pages/Components/Home/connect-modal.vue";
import {connectUsModalVisibility, modalSet} from "@/Pages/Components/Helper/Helper.js";
import DarkLight from "@/Pages/Components/Home/DarkLight.vue";
import {useIndexStore} from "@/Pages/Components/Helper/indexData.js";

const magic_mobile_nav = ref(false);
const info_mobile_nav = ref(false);
const isDark = useDark();
const toggleDark = useToggle(isDark);
const navSettings = useIndexStore().Settings.NavSetting.data;
const props = defineProps({
    settings: {
        type: Object,
        required: true
    }
});
document.addEventListener('click', () => {
    magic_mobile_nav.value = false;
    info_mobile_nav.value = false;
    connectUsModalVisibility.value = false;
});
const Brand = ref(null);
const Products = ref(null);
const AboutUs = ref(null);
const ConnectWithUs = ref(null);
const brands = ref(null);
navSettings.map(item => {
    if (item.title === 'برند ها')
        Brand.value = item;
    if (item.title === 'محصولات')
        Products.value = item;
    if (item.title === 'درباره ما')
        AboutUs.value = item;
    if (item.title === 'تماس با ما')
        ConnectWithUs.value = item;
});
onMounted(() => {
    axios.get(route('brands.show')).then((res) => {
        brands.value = res.data.data;
    }).catch(err => {
        console.log(err);
    });
})
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
                <div v-for="(item,index) in navSettings" class=" group relative">
                    <div v-if="item.link === ''" class="flex items-center"
                         @click.stop="item.title==='تماس با ما'?connectUsModalVisibility=!connectUsModalVisibility:''">
                        <div class="header-items" :class="{'relative group':item.title==='محصولات'}">
                            <svg-component :name="item.icon" class="size-7"/>
                            <h2 class="">{{ item.title }}</h2>
                        </div>
                        <div v-if="index!==navSettings.length-1" class="separate"></div>
                    </div>
                    <Link v-else :href="route(item.link)" class="flex items-center gap-2">
                        <div class="header-items">
                            <svg-component :name="item.icon" class="size-7"/>
                            <h2 class="">{{ item.title }}</h2>
                        </div>
                        <div v-if="index!==navSettings.length-1" class="separate"></div>
                    </Link>
                    <!--                    products-list-->
                    <Link :href="route('AllProductsShow')" v-if="item.title==='محصولات'" class="header-item-lists">
                        <div class="mega-tab-items relative" v-for="(navItem, index) in item.items">
                            <div class="relative overflow-hidden p-4 hover:overflow-visible">
                                <Link :href="route('attributes.sendToShow',{id:navItem.id,slug:navItem.slug})" class="mega-tab-menu-items">
                                    <img :src="navItem.icon" alt="" class=" size-8 rounded-full">
                                    <h2 class="">{{ navItem.name }}</h2>
                                </Link>
                                <div class="mega-tab-menu-list" :style="'top: -' + index * 66 + 'px' ">
                                    <div class="text-nowrap w-fit flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6">
                                        <div class=""
                                             v-for="navItemBrand in navItem.brands">
                                            <p class="border-r-4 pr-1 border-defaultColor font-bold">
                                                {{ navItemBrand.name }}
                                            </p>
                                            <div class="" v-for="navItemBrandItems in navItemBrand.products">
                                                <Link
                                                    :href="route('ProductShow',{id:ItemVariations.id,slug:ItemVariations.slug})"
                                                    class="block pr-2 mega-tab-menu-list-items"
                                                    v-for="ItemVariations in navItemBrandItems.variations">
                                                    {{ ItemVariations.name + ' ' + ItemVariations.value }}
                                                </Link>
                                            </div>
                                        </div>
                                        <div class=""
                                             v-for="navItemCategory in navItem.categories">
                                            <p class="border-r-4 pr-1 border-defaultColor font-bold">
                                                {{ navItemCategory.name }}
                                            </p>
                                            <div class="" v-for="navItemCategoryItems in navItemCategory.products">
                                                <Link
                                                    :href="route('ProductShow',{id:ItemVariations.id,slug:ItemVariations.slug})"
                                                    class="block pr-2 mega-tab-menu-list-items"
                                                    v-for="ItemVariations in navItemCategoryItems.variations">
                                                    {{ ItemVariations.name + ' ' + ItemVariations.value }}
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-52 h-full overflow-hidden">
                                        <img :src="navItem.icon"
                                             class="size-full hidden lg:block" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                    <!--                    brands-list-->
                    <div v-if="item.title==='برند ها'" class="header-item-lists !right-0 w-80 p-3">
                        <div class="grid grid-cols-2 gap-3 justify-items-center overflow-y-auto max-h-96">
                            <Link v-for="item in brands" :href="route('brands.products.show',{id:item.id,slug:item.slug})"
                                  class="h-12 w-fit min-w-32 border border-black overflow-hidden flex gap-3 items-center rounded-xl">
                                <img :src="item.icon" alt="" class="size-12">
                                <p class="font-bold text-sm text-black">{{item.name}}</p>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
            <!--            connection svgs-->
            <div class="flex gap-2 text-defaultColor4 items-center lg:gap-4">
                <!--                telegram-->
                <a :href="'t.me:'+settings.telegram"
                   class="header-connection-svg after:left-[-14px] hover:after:content-['تلگرام']">
                    <svg-component name="telegram" title="جوانه سبز در تلگرام" class="size-8"/>
                </a>
                <!--                instagram-->
                <a :href="'https://instagram.com/'+settings.instagram"
                   class="header-connection-svg after:left-[-29px] hover:after:content-['اینستاگرام']">
                    <svg-component name="instagram" title="جوانه سبز در اینستاگرام" class="size-8"/>
                </a>
                <!--                whatsapp-->
                <a :href="'https://wa.me/'+settings.whatsapp"
                   class="header-connection-svg after:left-[-19px] hover:after:content-['واتساپ']">
                    <svg-component name="whatsapp" title="جوانه سبز در واتساپ" class="size-7"/>
                </a>
            </div>
        </div>
    </div>
    <!--    mobile-->
    <div class="w-full mx-auto fixed bottom-0 px-10 items-center z-20 h-16 bg-opacity-70 text-defaultColor
     rounded-t-full bg-defaultColor flex justify-between md:hidden">
        <!--        darkMode & like & lessons-->
        <div class="home_mobile_navigation_items relative" @click.stop="magic_mobile_nav = !magic_mobile_nav">
            <svg-component name="magic" class="size-[80%] sm:size-10"/>
            <div
                :class="['absolute w-fit flex gap-3 p-4 items-center -right-12 top-10 duration-500 ease-out opacity-0 text-black' , {'opacity-100 !-top-20': magic_mobile_nav}]">
                <DarkLight/>
                <div @click="modalSet('Favorite')"
                     :class="{'mt-0':Brand===null}"
                     class="bg-slate-700 bg-opacity-50 p-1 text-red-600 rounded-lg fill-none -mt-10 hover:fill-red-900">
                    <svg-component name="like" class="size-7"/>
                </div>
                <Link :href="route(Brand.link)" v-if="Brand!==null"
                      class="bg-slate-700 bg-opacity-50 p-1 text-blue-600 rounded-lg">
                    <svg-component :name="Brand.icon" class="size-7"/>
                </Link>
            </div>
        </div>
        <!--        buyCart-->
        <div @click="modalSet('BuyCart')" class="home_mobile_navigation_items">
            <svg-component name="cart" title="سبد خرید" class="size-[70%] sm:size-10"/>
        </div>
        <!--        home-->
        <Link href="/">
            <div class="cursor-pointer flex justify-center items-center duration-500 -mt-10 hover:-translate-y-2">
                <img :src="settings.icon" title="خانه" class="size-20 sm:size-32" alt="">
            </div>
        </Link>
        <!--        products-->
        <Link :href="route(Products!==null?Products.link:'index')" class="home_mobile_navigation_items">
            <svg-component name="strawberry" title="محصولات" class="size-[70%] sm:size-10"/>
        </Link>
        <!--        aboutUs & connectWithUs-->
        <div class="home_mobile_navigation_items relative" @click.stop="info_mobile_nav=!info_mobile_nav">
            <svg-component name="about" class="size-[70%] sm:size-10"/>
            <div
                :class="['absolute w-fit flex gap-3 p-4 items-center -right-11 top-10 duration-500 ease-out opacity-0 text-black' , {'opacity-100 !-top-20': info_mobile_nav}]">
                <Link v-if="AboutUs!==null" href="/درباره ما">
                    <div class="bg-slate-700 bg-opacity-50 p-1 text-gray-200 rounded-lg fill-none hover:fill-red-900">
                        <svg-component name="about" class="size-7"/>
                    </div>
                </Link>
                <div v-if="ConnectWithUs!==null" class="bg-slate-700 bg-opacity-50 p-1 text-defaultColor rounded-lg"
                     @click.stop="connectUsModalVisibility=!connectUsModalVisibility">
                    <svg-component name="tell" class="size-7"/>
                </div>
            </div>
        </div>
    </div>
    <connect-modal v-if="connectUsModalVisibility"/>
</template>

