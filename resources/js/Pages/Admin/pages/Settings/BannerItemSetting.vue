<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";
import {useToast} from "vue-toastification";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    modelName: {
        required: true,
    },
    itemId: {
        required: true,
        type: Number,
    },
    banner: {
        required: true,
        type: Object,
    }
});
const modal = ref();
const modal_status = ref(false);
const attributes = ref();
const attribute = ref(null);
const loading = ref(false);
onMounted(async () => {
    loading.value = true;
    document.addEventListener('click', modalCloser);
    axios.get(route('admin.banner.getAttribute', props.itemId)).then(res => {
        loading.value = false;
        attribute.value = res.data.attribute;
        attributes.value = res.data.attributes;
    }).catch(err => {
        loading.value = false;
    });
});

const modalCloser = (e) => {
    if (!modal.value.contains(e.target) && modal_status.value) {
        modal_status.value = false;
    }
}
onBeforeUnmount(() => {
    document.removeEventListener('click', modalCloser);
});

const changeAttribute = async (id) => {
    loading.value = true;
    await axios.patch(route('admin.banner.attributeToggle', {banner_id: props.itemId, attribute_id: id})).then(res => {
        loading.value = false;
        attribute.value = res.data.attribute;
        attributes.value = res.data.attributes;
    }).catch(err => {
        loading.value = false;

    });
}


</script>

<template>
    <LoadingComponent :loading="loading"/>
    <div
        class="w-48 flex !justify-center bg-adminColor2 duration-500 transition-all overflow-hidden rounded-xl
         border-2 border-current dark:bg-adminColor3"
        ref="modal"
        :class="{'fixed z-50 top-20 no-scrollbar !size-5/6 py-6 overflow-scroll !bg-adminColor1 dark:!bg-adminColor3 left-10':modal_status,' hover:scale-95':!modal_status}">
        <div v-if="!modal_status" @click.stop="modal_status = true" ref="modal"
             class="size-full flex relative justify-center cursor-pointer overflow-hidden items-center px-3 ">
            <div class="absolute z-10 top-10 p-1 rounded-xl bg-gray-50/80">{{ modelName }}</div>
            <div
                class="size-48 text-center space-y-2 cursor-pointer rounded-xl overflow-hidden border-4
                border-transparent duration-300 relative flex justify-center">
                <img :src="banner.icon" alt="" class="size-full">
                <div
                    class="w-1/2 absolute bottom-10 p-1 rounded-xl  text-center bg-gray-50/80 dark:bg-gray-900/50 text-sm">
                    {{ attribute !== null ? attribute.name : 'تنظیم نشده' }}
                </div>
            </div>
        </div>
        <div v-else class="">
            <div v-if="attributes.length>0 || attribute!==null" class="flex justify-center gap-5">
                <div class="p-5 space-y-4">
                    <AttributeItem :choosable="true" :selected="true" v-if="attribute"
                                   @selected="changeAttribute(attribute.id)" :Attribute="attribute"/>
                    <AttributeItem v-for="item in attributes" :choosable="true"
                                   @selected="changeAttribute(item.id)" :Attribute="item"/>
                </div>
            </div>
            <div v-else class="text-center text-black text-lg font-bold" @click="">
                هنوز خصوصیتی ساخته نشده است.
            </div>
        </div>
    </div>
</template>

