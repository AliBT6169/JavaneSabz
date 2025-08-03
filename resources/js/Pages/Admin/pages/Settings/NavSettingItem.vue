<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminActiveDeActiveInput from "@/Pages/Admin/Components/AdminActiveDeActiveInput.vue";
import {ref} from "vue";
import {useToast} from "vue-toastification";
import NavItemSelectionModal from "@/Pages/Admin/pages/Settings/NavItemSelectionModal.vue";

const props = defineProps({
    setting: Object,
    myKey: '',
});
const emit = defineEmits({
    move: Number,
});
const is_active = ref(props.setting.is_active);
const is_activeChanged = async () => {
    await axios.patch(route('admin.navSetting.toggle', props.setting.id)).then(res => {
        useToast().success(res.data);
    }).catch(err => {
        useToast().error(err.response.data.message);
    });
}
const queueChanged = async (e) => {
    await axios.patch(route('admin.navSetting.queueToggle'), {
        id: props.setting.id,
        state: e,
    }).then(res => {
        emit('move', res.data.data)
        useToast().success(res.data.message);
    }).catch(err => {
        useToast().error(err.response.data.message);
    });
}
</script>

<template>
    <div class="border-2 border-adminColor2 p-2 rounded-xl space-y-1">
        <div :class="{'flex gap-2 items-center justify-center':setting.title==='محصولات'}">
            <div class="size-6 text-center border-2 border-current rounded-full m-auto"
                 :class="{'!m-0':setting.title === 'محصولات'}">{{ setting.queue }}
            </div>
            <NavItemSelectionModal v-if="setting.title === 'محصولات'" model-name="تنظیمات"/>
        </div>
        <div class=" flex justify-between items-center">
            <!--            perv-->
            <div class="w-5">
                <svg-component v-if="setting.queue>0" name="next" @click="queueChanged(-1)"
                               class="cursor-pointer size-5 rotate-180 duration-300 hover:text-adminColor2 hover:scale-110"/>
            </div>
            <div class="flex items-center gap-2 border-2 rounded-xl p-2 border-adminColor2">
                <svg-component :name="setting.icon" class="size-7"/>
                <div class="">{{ setting.title }}</div>
            </div>
            <!--            next-->
            <div class="w-5">
                <svg-component v-if="setting.queue<4" name="next" @click="queueChanged(1)"
                               class="cursor-pointer size-5 duration-300 hover:text-adminColor2 hover:scale-110"/>
            </div>
        </div>
        <AdminActiveDeActiveInput class="text-nowrap" v-model="is_active" :my-key="myKey" @update:modelValue="is_activeChanged"/>
    </div>
</template>
