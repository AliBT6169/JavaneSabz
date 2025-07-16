<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import AdminOrderProductSelectItem from "@/Pages/Admin/Components/Order/AdminOrderProductSelectItem.vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    order_items: {
        required: true,
    }
});
const emit = defineEmits({
    dataSend: null,
});

const modal = ref('');
const modal_status = ref(false);
const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
const selectedProducts = ref();
const Products = ref();
onMounted(() => {
    document.addEventListener('click', modalCloser);
    const ides = ref([]);
    props.order_items.map((item) => {
        ides.value.push(item.product_variation_id);
    });
    axios.post(route('admin.orders.getProducts'), ides.value).then(res => {
        selectedProducts.value = res.data.selectedProducts;
        selectedProducts.value.map((product) => {
            props.order_items.map((item) => {
                if (item.product_variation_id === product.id) {
                    product.order_quantity = item.quantity;
                }
            });
        });
        Products.value = res.data.products;
        Products.value.map((product) => {
            product.order_quantity = 0;
        });
    }).catch(err => {
        console.log(err);
    });
});

onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});
const dataSender = () => {
    emit('dataSend', [1, 2, 3]);
    modal_status.value = false;
}
</script>

<template>
    <div class="size-40 flex !justify-center bg-adminColor2 duration-500 overflow-hidden rounded-xl border"
         ref="modal"
         :class="{'fixed z-50 top-20 size-fit md:size-5/6 py-6 overflow-scroll':modal_status}">
        <div :class="{'hidden':!modal_status}" class="flex gap-5 justify-center flex-wrap">
            <AdminOrderProductSelectItem v-for="item in selectedProducts" v-model="item.order_quantity" :order-item="item"/>
            <AdminOrderProductSelectItem v-for="item in Products" :order-item="item"/>
        </div>
        <div @click.stop="modal_status = true" class="flex justify-center items-center cursor-pointer m-auto duration-300 size-full rounded-xl border-4 border-adminColor2
             dark:border-adminColor3 hover:scale-95 overflow-hidden"
             :class="{'hidden':modal_status}">
            مشاهده {{ order_items.length }} محصولات
        </div>
    </div>
</template>
