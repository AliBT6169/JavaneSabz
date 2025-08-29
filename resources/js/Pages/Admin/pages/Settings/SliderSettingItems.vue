<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";

const props = defineProps({
    modelName: {
        required: true,
    },
    itemId: {
        required: true,
        type: Number,
    },
    slider: {
        required: true,
        type: Object,
    }
});
const emit = defineEmits({
    created: {}
});
const modal = ref();
const modal_status = ref(false);
const attributes = ref();
const attribute = ref(null);
onMounted(async () => {
    document.addEventListener('click', modalCloser);
    axios.get(route('admin.slider.getAttribute', props.itemId ?? 0)).then(res => {
        attribute.value = res.data.attribute;
        attributes.value = res.data.attributes;
    }).catch(err => {
        console.log(err);
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
    await axios.patch(route('admin.slider.attributeToggle', {
        slider_id: props.itemId ?? 0,
        attribute_id: id
    })).then(res => {
        attribute.value = res.data.attribute;
        attributes.value = res.data.attributes;
        emit('created',res.data.slider);
    });
}


</script>

<template>
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
                <img v-if="attribute" :src="attribute.image" alt="" class="size-full">
                <div
                    class="w-1/2 absolute bottom-10 p-1 rounded-xl  text-center bg-gray-50/80 dark:bg-gray-900/50 text-sm">
                    {{ attribute !== null ? attribute.name : 'تنظیم نشده' }}
                </div>
            </div>
        </div>
        <div v-else class="">
            <div v-if="attributes.length>0" class="flex justify-center gap-5">
                <div class="p-5 space-y-4">
                    <AttributeItem :choosable="true" :selected="true" v-if="attribute" :Attribute="attribute"/>
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

