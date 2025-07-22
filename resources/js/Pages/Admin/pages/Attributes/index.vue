<script setup>
import AdminHeader from "@/Pages/Admin/Components/AdminHeader.vue";
import AdminSideBar from "@/Pages/Admin/Components/AdminSideBar.vue";
import Layout from "@/Pages/Admin/Components/Layout.vue";
import AttributeItem from "@/Pages/Admin/Components/AttributeItem.vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import AdminInput from "@/Pages/Admin/Components/AdminInput.vue";
import {ref} from "vue";

const props = defineProps({
    Attributes: {
        required: true,
    }
});
const filteredAttributes = ref(props.Attributes.data);
const attributeDeleted = (id) => {
    props.Attributes.data = props.Attributes.data.filter((item) => item.id !== id);
}
const searchKeyWord = ref("");
const searchKeyWordChanged = (e) => {
    filteredAttributes.value = props.Attributes.data.filter((item) => item.name.includes(e));
}
</script>

<template>
    <AdminHeader/>
    <AdminSideBar/>
    <Layout>
        <div class="space-y-4">
            <AdminInput v-model="searchKeyWord" class="md:w-1/2" name="جستجو"
                        @update:modelValue="searchKeyWordChanged($event)"/>
            <AttributeItem v-for="item in filteredAttributes" :Attribute="item" @deleted="attributeDeleted($event)"/>
            <div class="flex justify-center">
                <Link :href="route('admin.attributes.create')"
                      class="border-2 cursor-pointer border-black rounded-xl duration-300 p-2 hover:scale-95">
                    <svg-component name="plus" class="size-40"/>
                </Link>
            </div>
        </div>
    </Layout>
</template>
