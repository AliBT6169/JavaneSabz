<script setup>
import {onMounted, ref} from "vue";
import InputBT1 from "@/Pages/Components/Form/Input-BT1.vue";
import {connectUsModalVisibility} from "@/Pages/Components/Helper/Helper.js";
import ToastWarning from "@/Pages/Admin/Components/ToastWarning.vue";
import {useToast} from "vue-toastification";

const connectUsFormVisibility = ref(false);
onMounted(() => {
    setTimeout(() => {
        connectUsFormVisibility.value = true;
    }, 100)
});
const form = ref({
    name: '',
    phone: '',
    text: '',
})

const sendText = () => {
    const content = {
        component: ToastWarning,
        props: {
            message: 'آیا مطمعن از ارسال این پیام به مدیریت مطمعن هستید؟',
        },
        listeners: {
            set: async () => {
                await axios.post(route('textToAdmin'), form.value).then(res => {
                    useToast().success(res.data)
                }).catch(err => {
                    console.log(err)
                    useToast().error(err.response.data.message)
                });
            }
        }
    }
    useToast().warning(content);
}
</script>

<template>
    <div
        class="h-screen w-screen fixed z-20 top-0 left-0 bg-slate-800 bg-opacity-50 flex items-center justify-center">
        <div class="invisible opacity-0 border-2 border-defaultColor5 -translate-y-96 h-fit w-72 rounded-xl bg-slate-800 lg:bg-opacity-50
        dark:bg-slate-500 lg:dark:bg-opacity-50 py-4 lg:dark:hover:bg-opacity-100 transition-all duration-500
         lg:hover:bg-opacity-100 md:w-96"
             :class="{'!visible !translate-y-0 !opacity-100':connectUsFormVisibility}">
            <form class="size-full p-4 items-center gap-2 flex flex-col" @submit="sendText" @click.stop>
                <div class="text-lg font-bold text-defaultColor5 border-x-4 rounded-2xl p-1 border-defaultColor">برای ما
                    پیام بفرستید
                </div>
                <InputBT1 v-model="form.name" label-text="نام و نام خانوادگی:"></InputBT1>
                <InputBT1 v-model="form.phone" label-text="شماره همراه:"></InputBT1>
                <InputBT1 v-model="form.text" label-text="پیام:" :multi-line="true"></InputBT1>
                <div class="flex w-full justify-end gap-2 items-center">
                    <div
                        class="px-4 py-2 rounded-lg bg-defaultColor5 dark:text-white dark:bg-defaultColor cursor-pointer"
                        @click="sendText">ثبت
                    </div>
                    <div class="px-4 py-2 rounded-lg dark:text-white cursor-pointer bg-red-500 dark:bg-red-800"
                         @click="connectUsModalVisibility=false">لغو
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
