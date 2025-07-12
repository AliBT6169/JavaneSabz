<script setup>
import {ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    Attribute: {
        required: true,
    }
});
const is_active = ref(props.Attribute.is_active);

const toggle = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.patch(route('admin.attributes.toggle', {id: props.Attribute.id})).then(res => {
                    useToast().success(res.data);
                    is_active.value = !is_active.value;
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
    let toast = useToast();
    toast.warning(content);
}
</script>

<template>
    <div
        class="text-center border-2 cursor-pointer border-black rounded-xl group p-2 lg:space-y-6">
        <div class="space-y-2 lg:flex lg:space-y-0 lg:items-center lg:gap-6">
            <div class="w-full relative flex justify-center items-center lg:w-60">
                <img :src="Attribute.icon" alt=""
                     class="rounded-full duration-300 border-2 border-adminColor1 group-hover:scale-95 size-32 ">
                <div class="hidden size-40 absolute rounded-xl overflow-hidden lg:flex justify-center items-center">
                    <div
                        class="p-2 xl:px-6 rounded-xl translate-x-40 group-hover:translate-x-0 bg-white/20 duration-300 dark:bg-gray-800/20">
                        مشاهده
                    </div>
                </div>
            </div>
            <div
                class="flex flex-wrap gap-8 items-center border-b-2 pb-2 border-black dark:border-white lg:border-0 lg:p-0 md:justify-around md:w-full">
                <div class=""><span class="">نام: </span>{{ Attribute.name }}</div>
                <div class=""><span class="">محصول: </span>{{ Attribute.products_count }}</div>
                <div class=""><span class="">موجودیت محصول: </span>{{ Attribute.product_variations_count }}
                </div>
                <div class=""><span class="">برند: </span>{{ Attribute.brands_count }}</div>
                <div class=""><span class="">دسته بندی: </span>{{
                        Attribute.categories_count
                    }}
                </div>
            </div>
            <div class="w-full lg:hidden"><span class="">توضیحات :</span>
                {{ Attribute.description }}
            </div>
            <div class="flex gap-2 items-center lg:block lg:space-y-2">
                <div class="py-1 w-full rounded-lg border border-black lg:px-10"
                     @click="toggle"
                     :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                    {{ is_active ? 'فعال' : 'غیرفعال' }}
                </div>
                <Link
                    class="block bg-adminColor1 py-1 w-full rounded-lg border border-black lg:px-10 dark:bg-adminColor4"
                    :href="route('admin.attributes.edit',{id:Attribute.id})">
                    پیکربندی
                </Link>
                <div @click="deleter"
                     class="p-1 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30 lg:w-full">
                    <svg-component name="delete" class="size-6 lg:m-auto"/>
                </div>
            </div>
        </div>
        <div class="hidden lg:block"><span class="">توضیحات :</span>
            {{ Attribute.description }}
        </div>
    </div>
</template>
