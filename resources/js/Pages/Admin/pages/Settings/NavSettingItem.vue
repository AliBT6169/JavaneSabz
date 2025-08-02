<script setup>

import SvgComponent from "@/Pages/Components/svg-component.vue";
import AdminActiveDeActiveInput from "@/Pages/Admin/Components/AdminActiveDeActiveInput.vue";
import {ref} from "vue";
import {useToast} from "vue-toastification";

const props = defineProps({
    setting: Object,
    myKey: '',
});
const is_active = ref(props.setting.is_active);
const is_activeChanged = async () => {
    await axios.patch(route('admin.navSetting.toggle',props.setting.id)).then(res=>{
        useToast().success(res.data);
    }).catch(err=>{
        useToast().error(err.response.data.message);
    });
}
</script>

<template>
    <div class="border-2 border-adminColor2 p-2 rounded-xl space-y-1">
        <div class="size-6 text-center border-2 border-current rounded-full m-auto">{{ setting.queue }}</div>
        <div class=" flex justify-between items-center">
<!--            perv-->
            <div class="w-5">
                <svg-component v-if="setting.queue>0" name="next" class="cursor-pointer size-5 rotate-180"/>
            </div>
            <div class="flex items-center gap-2 border-2 rounded-xl p-2 border-adminColor2">
                <svg-component :name="setting.icon" class="size-7"/>
                <div class="">{{ setting.title }}</div>
            </div>
<!--            next-->
            <div class="w-5">
                <svg-component v-if="setting.queue<4" name="next" class="cursor-pointer size-5"/>
            </div>
        </div>
        <AdminActiveDeActiveInput v-model="is_active" :my-key="myKey"  @update:modelValue="is_activeChanged"/>
    </div>
</template>
