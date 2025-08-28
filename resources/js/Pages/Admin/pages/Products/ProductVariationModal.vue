<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminActiveDeActiveInput from "@/Pages/Admin/Components/AdminActiveDeActiveInput.vue";

const props = defineProps({
    variation_data: null,
    component_index: null
});
const emit = defineEmits({
    dataSend: null,
    delete: null,
});

const images = new FormData();
const VariationImages = ref([]);

const variationData = ref({
    id: props.variation_data.id ?? -1,
    size: props.variation_data.value ?? '',
    passedImages: props.variation_data.images ?? [],
    weight: props.variation_data.weight ?? '',
    price: props.variation_data.price ?? '',
    quantity: props.variation_data.quantity ?? '',
    off_sale: props.variation_data.off_sale ?? '',
    is_active: props.variation_data.is_active ?? 1,
    is_special: props.variation_data.is_special!== 0,
});
console.log(variationData.value)
const modal = ref('');
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}

onMounted(() => {
    document.addEventListener('click', modalCloser);
    setTimeout(() => {
        emit('dataSend', {
            'images': images,
            'data': variationData.value,
        });
    }, 500)
});

onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
const addImage = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            VariationImages.value.push(e.target.result);
        };
        reader.readAsDataURL(file);
        let count = 0;
        for (let pair of images.entries()) {
            count++;
        }
        images.append('image' + count, event.target.files[0]);
    }
}
const changeImage = (event, index) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onloadend = (e) => {
            VariationImages.value[index] = e.target.result;
            images.set('image' + index, event.target.files[0])
        };
        reader.readAsDataURL(file);
    }
};
const dataSender = () => {
    emit('dataSend', {
        'images': images,
        'data': variationData.value,
    });
    modal_status.value = false;
}
</script>

<template>
    <div class="size-40 flex !justify-center bg-adminColor2 duration-500 overflow-hidden rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 size-5/6 py-6 overflow-scroll':modal_status}">
        <form :class="{'hidden':!modal_status}" class="w-full">
            <div class="flex gap-5 flex-wrap justify-center">
                <!--                passed image section-->
                <label v-if="typeof variationData.passedImages !=='string'"
                       v-for="(item, index) in variationData.passedImages" :key="index"
                       :for="'variation-image' + index"
                       class="relative cursor-pointer m-auto duration-300 size-40 rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden group">
                    <svg-component
                        @click.stop.prevent="variationData.passedImages.splice(index,1)"
                        name="delete" class="bg-black/50 duration-300 p-1 rounded-lg absolute size-7 top-[66px] -right-20
                    group-hover:right-16"/>
                    <input type="file" :id="'variation-image' + index" accept="*image/*"
                           class="invisible absolute"
                           @input="changeImage($event ,index),variationData.passedImages.splice(index,1)">
                    <img
                        :src="item.image"
                        class="size-full"
                        alt="">
                </label>
                <!--                new images section-->
                <label v-for="(item, index) in VariationImages" :key="index"
                       :for="'variation-image' + index"
                       class="relative cursor-pointer m-auto duration-300 size-40 rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden group">
                    <svg-component @click.stop.prevent="VariationImages.splice(index,1), images.delete('image'+index)"
                                   name="delete" class="bg-black/50 duration-300 p-1 rounded-lg absolute size-7 top-[66px] -right-20
                    group-hover:right-16"/>
                    <input type="file" :id="'variation-image' + index" accept="*image/*"
                           class="invisible absolute" @input="changeImage($event ,index)">
                    <img
                        :src="item"
                        class="size-full"
                        alt="">
                </label>
                <!--            add image-->
                <label :for="'add-variation-image' + component_index" class="relative cursor-pointer m-auto duration-300 size-32 rounded-xl border-4 bg-adminColor3 border-adminColor2 flex justify-center items-center
             dark:border-adminColor3 hover:scale-95 overflow-hidden">
                    <input type="file" :id="'add-variation-image'+component_index" accept="*image/*"
                           class="invisible absolute" @input="addImage">
                    <div class="text-6xl text-center">+</div>
                </label>
            </div>
            <div
                class="p-2 space-y-5 *:space-y-5 md:space-y-0 md:*:space-y-0 md:*:flex *:gap-5 *:justify-center *:w-full ">
                <div class="">
                    <admin-input name="اندازه" v-model="variationData.size"/>
                    <admin-input name="وزن به KG" type="number" v-model="variationData.weight"/>
                </div>
                <div class="">
                    <admin-input name="تعداد" type="number" v-model="variationData.quantity"/>
                    <admin-input name="تخفیف به %" v-model="variationData.off_sale"/>
                </div>
                <div class="">
                    <AdminActiveDeActiveInput v-model="variationData.is_active"/>
                    <admin-input name="قیمت به تومان" type="number" v-model="variationData.price"/>
                </div>
                <div class="!block pl-2 !w-fit">
                    <div class="space-y-0.5 text-sm">
                        <div class="px-2">ویژه:</div>
                        <div class="admin_inputs flex items-center">
                            <input type="checkbox" v-model="variationData.is_special"
                                   :key="'is_special'+component_index">
                        </div>
                    </div>
                </div>
            </div>
            <div class="gap-5 *:text-center md:flex md:justify-end *:my-2 px-2">
                <div @click="dataSender" class="px-12 py-2 rounded-xl duration-300 cursor-pointer border-2 bg-adminColor1 border-adminColor2
     dark:bg-adminColor3 dark:border-adminColor4 hover:scale-95 hover:shadow-inner hover:shadow-gray-500">ثبت
                </div>
                <div @click="modal_status = false"
                     class="px-12 w-full py-2 rounded-xl duration-300 cursor-pointer border-2 bg-red-300 border-red-600
                    dark:bg-red-400 dark:border-red-800 hover:scale-95 hover:shadow-inner hover:shadow-gray-500 md:w-fit">
                    لغو
                </div>
            </div>
        </form>
        <div @click.stop="modal_status = true" class="relative group cursor-pointer m-auto duration-300 size-full rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden"
             :class="{'hidden':modal_status}">
            <svg-component @click.stop.prevent="emit('delete')" name="delete" class="bg-black/50 duration-300 p-1 rounded-lg absolute size-7 top-2 -left-20
                    group-hover:left-2"/>
            <img v-if="variationData.passedImages[0]!==undefined&&typeof variationData.passedImages[0] !=='string'"
                 :src="variationData.passedImages[0].image"
                 class="size-full"
                 alt="">
            <img v-else :src="VariationImages[0] === undefined?'/images/default/product.png':VariationImages[0]"
                 class="size-full"
                 alt="">
        </div>
    </div>
</template>
