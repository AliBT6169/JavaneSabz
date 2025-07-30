<script setup>
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {ref} from "vue";
import AdminCreateButton from "@/Pages/Admin/Components/AdminCreateButton.vue";
import AdminUserMailItem from "@/Pages/Admin/pages/UserMails/AdminUserMailItem.vue";
import AdminPageShower from "@/Pages/Admin/Components/AdminPageShower.vue";

const props = defineProps({
    Attributes: {
        required: true,
    }
});
const filteredAttributes = ref(props.Attributes.data);
const attributeDeleted = (id) => {
    props.Attributes.data = props.Attributes.data.filter((item) => item.id !== id);
    filteredAttributes.value = props.Attributes.data.filter((item) => item.id !== id);
}
const searchKeyWord = ref("");
const searchKeyWordChanged = (e) => {
    filteredAttributes.value = props.Attributes.data.filter((item) => item.name.includes(e));
}
const pageCount = ref({
    currentPage: props.Attributes.meta.current_page,
    from: props.Attributes.meta.last_page,
});
</script>

<template>
    <Layout>
        <AdminPageShower PageName="خصوصیت ها" :PageCount="pageCount"/>
        <div class="space-y-4">
            <AdminInput v-if="filteredAttributes.length>0" v-model="searchKeyWord" class="!m-auto md:w-1/2" name="جستجو"
                        @update:modelValue="searchKeyWordChanged($event)"/>
            <AttributeItem v-if="filteredAttributes.length>0" v-for="item in filteredAttributes" :Attribute="item" @deleted="attributeDeleted($event)"/>
            <div v-else class="text-center text-xl font-bold">هنوز خصوصیتی نساختید!</div>
            <div class="flex justify-center">
                <AdminCreateButton table-name="attributes"/>
            </div>
        </div>
    </Layout>
</template>
