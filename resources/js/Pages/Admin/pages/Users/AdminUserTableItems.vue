<script setup>

import {Link} from "@inertiajs/vue3";
import SvgComponent from "@/Pages/Components/svg-component.vue";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import axios from "axios";
import {useToast} from "vue-toastification";
import {ref} from "vue";

const props = defineProps({
    user: Object,
});
const userDeleted = ref(false);
const userDelete = async (id) => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن هستید؟'
        },
        listeners: {
            set: async () => {
                await axios.delete(route('admin.users.destroy', {'id': id})).then((res) => {
                    if (res.data.status === 200) {
                        useToast().success('کاربر با موفقیت حذف شد');
                        userDeleted.value = true;
                    }
                }).catch((err) => {
                })
            }
        }
    }
    let toast = useToast();
    toast.warning(content);
}
</script>

<template>
    <tr v-if="!userDeleted" class="h-12 cursor-pointer hover:!bg-adminColor2 duration-500">
        <td class="hidden md:table-cell w-[5%]">{{ user.id }}</td>
        <td class="">{{ user.full_name === '' ? 'خالی' : user.full_name }}</td>
        <td class="truncate">{{ user.user_name === '' ? 'خالی' : user.user_name }}</td>
        <td class="flex pt-2 justify-center items-center"><span
            class="group py-1 px-2 flex justify-center duration-500 bg-gray-500 rounded-lg relative hover:bg-gray-700">...
                        <div class="flex gap-2 justify-center items-center invisible opacity-0 top-0 duration-300 absolute lg:gap-6
                        *:border *:rounded-full *:p-1 *:duration-300 hover:*:text-red-500 hover:*:border-red-500 *:size-7
                         group-hover:visible group-hover:opacity-100 group-hover:-top-5">
                            <svg-component class="size-full" name="delete" @click="userDelete(user.id)"/>
                            <Link class="block" :href="route('admin.users.edit',{'id':user.id})"><svg-component
                                class="size-full" name="edit"/></Link>
                        </div>
                    </span></td>
        <td class="w-[7%]">{{ user.is_admin ? 'مدیر' : 'کاربر' }}</td>
        <td class="hidden md:table-cell w-[7%]">{{ user.gender === 1 ? 'آقا' : 'خانم' }}</td>
        <td class="">{{ user.cellphone }}</td>
        <td class="hidden md:table-cell truncate">{{ user.email }}</td>
    </tr>
</template>
