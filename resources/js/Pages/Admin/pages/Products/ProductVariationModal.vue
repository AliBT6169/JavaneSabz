<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios, {toFormData} from "axios";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {Link} from "@inertiajs/vue3";
import AdminButton from "@/Pages/Admin/Components/Admin-Button.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";

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
    'value': props.variation_data.value,
    'passedImages': props.variation_data.images ?? [],
    'weight': props.variation_data.weight,
    'price': props.variation_data.price,
    'quantity': props.variation_data.quantity,
    'off_sale': props.variation_data.off_sale,
});
console.log(variationData.value.passedImages);
const modal = ref('');
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}

onMounted(() => {
    document.addEventListener('click', modalCloser);
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
    <div class="size-40 flex !justify-center bg-adminColor2 duration-500 overflow-scroll rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 size-5/6 py-6':modal_status}">
        <form :class="{'hidden':!modal_status}" class="w-full">
            <div class="flex gap-5 flex-wrap justify-center">
                <label v-if="typeof variationData.passedImages !=='string'" v-for="(item, index) in variationData.passedImages" :key="index"
                       :for="'variation-image' + index"
                       class="relative cursor-pointer m-auto duration-300 size-40 rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden group">
                    <svg-component @click.stop.prevent="variationData.passedImages.splice(index,1),console.log(variationData.passedImages)"
                                   name="delete" class="bg-black/50 duration-300 p-1 rounded-lg absolute size-7 top-[66px] -right-20
                    group-hover:right-16"/>
                    <input type="file" :id="'variation-image' + index" accept="*image/*"
                           class="invisible absolute" @input="changeImage($event ,index)">
                    <img
                        :src="item.image"
                        class="size-full"
                        alt="">
                </label>
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
                    <admin-input name="اندازه" :default_value="variationData.value"
                                 @changed="variationData.value=$event"/>
                    <admin-input name="وزن به KG" :default_value="variationData.weight"
                                 @changed="variationData.weight=$event"/>
                </div>
                <div class="">
                    <admin-input name="تعداد" :default_value="variation_data.quantity"
                                 @changed="variationData.quantity=$event"/>
                    <admin-input name="تخفیف به %" :default_value="variationData.off_sale"
                                 @changed="variationData.off_sale=$event"/>
                </div>
                <div class="!block pl-2 !w-1/2">
                    <admin-input name="قیمت به تومان" :default_value="variationData.price"
                                 @changed="variationData.price=$event"/>
                </div>
            </div>
            <div class="gap-5 *:text-center md:flex md:justify-end *:my-2 px-2">
                <admin-button text="ثبت" @click="dataSender" type="submit"/>
                <admin-button text="لغو" type="cancel" @click="modal_status = false"/>
            </div>
        </form>
        <div @click.stop="modal_status = true" class="relative group cursor-pointer m-auto duration-300 size-full rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 block overflow-hidden"
             :class="{'hidden':modal_status}">
            <svg-component @click.stop.prevent="emit('delete')" name="delete" class="bg-black/50 duration-300 p-1 rounded-lg absolute size-7 top-[66px] -right-20
                    group-hover:right-16"/>
            <img :src="VariationImages[0] === undefined?'/images/default/product.png':VariationImages[0]"
                 class="size-full"
                 alt="">
        </div>
    </div>
</template>
