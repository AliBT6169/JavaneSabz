<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import axios from "axios";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";
import {useToast} from "vue-toastification";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";

const props = defineProps({
    modelName: {
        required: true,
    },
    itemId: {
        required: true,
        type: Number,
    },
});
const modal = ref();
const modal_status = ref(false);
const attributes = ref();
const selectedAttributes = ref();
onMounted(async () => {
    document.addEventListener('click', modalCloser);
    axios.get(route('admin.navSetting.getAttributes', props.itemId)).then(res => {
        attributes.value = res.data.Attributes;
        selectedAttributes.value = res.data.selectedAttributes;
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

const setOrDeleteAttribute = (id, status) => {
    if (status) {
        attributes.value.map((item) => {
            if (item.id === id) {
                selectedAttributes.value.push(item);
            }
        });
        attributes.value = attributes.value.filter((item) => item.id !== id);
    } else {
        selectedAttributes.value.map((item) => {
            if (item.id === id) {
                attributes.value.push(item);
            }
        });
        selectedAttributes.value = selectedAttributes.value.filter((item) => item.id !== id);
    }

}

const sendData = async () => {
    const attribute = ref([]);
    selectedAttributes.value.map((item) => {
        attribute.value.push({
            id: item.id
        });
    });
    const form = {
        nav_id: props.itemId,
        attributes: attribute.value,
    }
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن به ذخیره این تغییرات هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.post(route('admin.navSetting.AttributeSet'), form, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT'
                    }
                }).then(res => {
                    useToast().success(res.data);
                }).catch(err => {
                    useToast().error(err.response.data.message);
                });
            }
        }
    }
    useToast().warning(content);
}
</script>

<template>
    <div
        class="w-[5.5rem] flex !justify-center bg-adminColor2 duration-500 transition-all overflow-hidden rounded-xl
         border-2 border-current dark:bg-adminColor3"
        ref="modal"
        :class="{'fixed z-50 top-20 no-scrollbar !size-5/6 py-6 overflow-scroll !bg-adminColor1 dark:!bg-adminColor3 left-10':modal_status,' hover:scale-95':!modal_status}">
        <div v-if="!modal_status" @click.stop="modal_status = true" ref="modal"
             class="size-fit flex justify-center cursor-pointer overflow-hidden items-center px-3 ">
            {{ modelName }}
        </div>
        <div v-else class="">
            <div class="p-5 space-y-4">
                <div class="text-center p-2 rounded-xl border-2 border-red-500">
                    <strong class="text-yellow-300">هشدار: </strong>
                    خصوصیت های انتخاب شده نباید محصول و موجودیت محصول داشته باشند!
                    <div @click="sendData"
                         class="mx-5 px-5 cursor-pointer bg-green-500/50 rounded-xl duration-300 inline-block border-2 border-adminColor1 hover:scale-95">
                        ثبت
                    </div>
                </div>
                <AttributeItem v-for="item in selectedAttributes" :choosable="true" :selected="true"
                               @selected="setOrDeleteAttribute(item.id, $event)" :Attribute="item"/>
                <AttributeItem v-for="item in attributes" :choosable="true" :selected="false"
                               @selected="setOrDeleteAttribute(item.id, $event)" :Attribute="item"/>
            </div>
        </div>
    </div>
</template>
