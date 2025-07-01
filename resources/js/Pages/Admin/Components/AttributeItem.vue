<script setup>
import {ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    attribute: {
        required: true,
    }
});
const Attribute = ref({
    id: 5,
    icon: '/images/default/default.jpg',
    description: 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.',
    name: 'خصوصیت',
    is_active: 0,
    brands_count: 2,
    categories_count: 5,
    products_count: 8,
    product_variations_count: 1,
});
const is_active = ref(Attribute.value.is_active);
</script>

<template>
    <div
        class="text-center border-2 cursor-pointer border-black rounded-xl group p-2 lg:space-y-6">
        <div class="space-y-2 lg:flex lg:space-y-0 lg:items-center lg:gap-6">
            <Link class="w-full relative flex justify-center items-center lg:w-60"
                  :href="route('admin.attributes.edit',{id:Attribute.id})">
                <img :src="Attribute.icon" alt=""
                     class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95 size-32 ">
                <div class="hidden size-40 absolute rounded-xl overflow-hidden lg:flex justify-center items-center">
                    <div
                        class="p-2 xl:px-6 rounded-xl translate-x-40 group-hover:translate-x-0 bg-white/20 duration-300 dark:bg-gray-800/20">
                        مشاهده
                    </div>
                </div>
            </Link>
            <div
                class="flex flex-wrap gap-2 items-center border-b-2 pb-2 border-black dark:border-white lg:border-0 lg:p-0 lg:gap-6">
                <div class="w-full"><span class="lg:block">نام: </span>{{ Attribute.name }}</div>
                <div class="w-full"><span class="lg:block">تعداد محصول: </span>{{ Attribute.products_count }}</div>
                <div class="w-full"><span class="lg:block">تعداد موجودیت محصول: </span>{{ Attribute.categories_count }}
                </div>
                <div class="w-full"><span class="lg:block">تعداد برند: </span>{{ Attribute.brands_count }}</div>
                <div class="w-full"><span class="lg:block">تعداد دسته بندی: </span>{{
                        Attribute.product_variations_count
                    }}
                </div>
            </div>
            <div class="w-full text-wrap lg:hidden"><span class="">توضیحات :</span>
                {{ Attribute.description }}
            </div>
            <div class="flex gap-2 items-center lg:block lg:space-y-2">
                <div class="py-1 w-full rounded-lg border border-black lg:px-10"
                     @click="toggle"
                     :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                    {{ is_active ? 'فعال' : 'غیرفعال' }}
                </div>
                <div @click="deleter"
                     class="p-1 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30 lg:w-full">
                    <svg-component name="delete" class="size-6 lg:m-auto"/>
                </div>
            </div>
        </div>
        <div class="w-full hidden lg:block"><span class="">توضیحات :</span>
            {{ Attribute.description }}
        </div>
    </div>
</template>
