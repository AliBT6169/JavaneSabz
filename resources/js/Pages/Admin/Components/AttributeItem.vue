<script setup>
import {ref} from "vue";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import {Link} from "@inertiajs/vue3";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";
import LoadingComponent from "@/Pages/Components/Home/LoadingComponent.vue";

const props = defineProps({
    Attribute: {
        required: true,
    },
    choosable: {
        type: Boolean,
    },
    selected: {
        type: Boolean,
    }
});
const attributeSelector = ref(null);
const emit = defineEmits('deleted', 'selected');

const is_active = ref(props.Attribute.is_active);
const loading = ref(false);

const toggle = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.patch(route('admin.attributes.toggle', {id: props.Attribute.id})).then(res => {
                    useToast().success(res.data);
                    is_active.value = !is_active.value;
                }).catch(err => {
                })
            }
        }
    }
    let toast = useToast();
    toast.warning(content);
}
const deleter = async () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا از حذف این خصوصیت مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                loading.value = true;
                await axios.delete(route('admin.attributes.destroy', props.Attribute.id)).then((res) => {
                    loading.value = false;
                    useToast().success('خصوصیت با موفقیت حذف شد.');
                    emit('deleted', props.Attribute.id);
                }).catch((err) => {
                    loading.value = false;
                    useToast().error(err.response.data.message);
                });
            }
        }
    }
    const toast = useToast();
    toast.warning(content);
}

const selector = () => {
    if (props.choosable) {
        attributeSelector.value.checked = !attributeSelector.value.checked;
        emit('selected', attributeSelector.value.checked);
    }
}
</script>

<template>
        <LoadingComponent :loading="loading"/>
    <div
        class="text-center border-2 border-black rounded-xl p-2 lg:space-y-6"
        :class="{'relative cursor-pointer':choosable}" @click.prevent.stop="selector">
        <div v-if="choosable" class="absolute size-7 rounded-xl overflow-hidden">
            <input @click.stop class="size-full cursor-pointer" :key="Attribute.id + 'choosable'" :checked="selected" type="checkbox" ref="attributeSelector"
                   @change="emit('selected',$event.target.checked)">
        </div>
        <div class="space-y-2 lg:flex lg:space-y-0 lg:items-center lg:gap-6">
            <div class="w-full flex justify-center items-center lg:w-60">
                <img :src="Attribute.icon" alt=""
                     class="rounded-full border-2 border-adminColor1 size-32 ">
            </div>
            <div
                class="flex flex-wrap gap-8 items-center border-b-2 pb-2 border-black dark:border-white lg:border-0 lg:p-0 md:justify-around md:w-full">
                <div class=""><span class="">نام: </span>{{ Attribute.name }}</div>
                <div class=""><span class="">محصول: </span>{{ Attribute.products_count }}</div>
                <div class=""><span class="">موجودیت محصول: </span>{{ Attribute.product_variations_count }}
                </div>
                <div class=""><span class="">برند: </span>{{ Attribute.brands_count }}</div>
                <div class=""><span class="">دسته بندی: </span>{{
                        Attribute.categories_count
                    }}
                </div>
            </div>
            <div class="w-full lg:hidden"><span class="">توضیحات :</span>
                {{ Attribute.description }}
            </div>
            <div class="flex gap-2 items-center lg:block lg:space-y-2">
                <div class="py-1 w-full rounded-lg border border-black lg:px-10"
                     @click="toggle"
                     :class="{'bg-green-500/70':is_active,'bg-red-500/70':!is_active }">
                    {{ is_active ? 'فعال' : 'غیرفعال' }}
                </div>
                <Link
                    class="block bg-adminColor1 py-1 w-full rounded-lg border border-black lg:px-10 dark:bg-adminColor4"
                    :href="route('admin.attributes.edit',{id:Attribute.id})">
                    پیکربندی
                </Link>
                <div @click="deleter"
                     class="p-1 rounded-xl bg-gray-800/30 duration-300 hover:text-red-500 dark:bg-white/30 lg:w-full">
                    <svg-component name="delete" class="size-6 lg:m-auto"/>
                </div>
            </div>
        </div>
        <div class="hidden lg:block"><span class="">توضیحات :</span>
            {{ Attribute.description }}
        </div>
    </div>
</template>
