<script setup>
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    product: null,
})
const is_active = ref(props.product.is_active);
const ActiveDeActive = async () => {
    await axios.patch(route('admin.products.active_DeActive', {id: props.product.id})).then((res) => {
        useToast().success(res.data.message);
        is_active.value = !is_active.value;
    }).catch((err) => {
        console.log(err.data)
    });
}
</script>

<template>
    <div class="pb-2 w-60 rounded-xl overflow-hidden border border-current space-y-4 cursor-pointer">
        <Link href="#">
            <img :src="product.image" class="w-full max-h-40 border" alt="">
        </Link>
        <div
            class="px-2 text-nowrap space-y-2 *:flex *:justify-between *:products-center *:gap-4 *:border-t *:border-current *:rounded-t-xl">
            <div class="">
                <div class="">نام محصول:</div>
                <div class="">{{ product.name }}</div>
            </div>
            <div
                class="p-1 *:px-1 *:border *:cursor-pointer *:duration-300 *:rounded-3xl *:shadow-md *:shadow-gray-500 hover:*:scale-95">
                <Link href="#"
                      class="bg-adminColor2">
                    تغییر اطلاعات
                    <svg-component name="edit" class="size-5 inline"/>
                </Link>
                <div class="bg-green-500 cursor-pointer" @click="ActiveDeActive"
                     :class="{'!bg-red-500':is_active===false}">
                    {{ is_active ? 'فعال' : 'غیر فعال' }}
                </div>
            </div>
            <div class="">
                <div class="">برند:</div>
                <div class="">{{ product.brand }}</div>
            </div>
            <div class="">
                <div class="">دسته بندی:</div>
                <div class="">{{ product.category }}</div>
            </div>
            <div class="!justify-start !gap-2 products-center flex-wrap pt-1">
                <div class="">سایزبندی:</div>
                <div v-for="(variation, index) in product.variations"
                     :class="{'border-l pl-2 border-current':product.variations.length-1> index}">
                    {{ variation.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
