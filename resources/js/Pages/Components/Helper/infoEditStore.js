import {defineStore} from "pinia";
import {useForm} from "@inertiajs/vue3";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";

export const useInfoEditStore = defineStore('EditStore', {
    state: () => ({
        formData: useForm({
            id: null,
            image: null,
            name: null,
            full_name: null,
            gender: null,
            cellphone: null,
            email: null,
            address: null,
            post_code: null,
        }),
    }),
    actions: {
        setForm(userInfo) {
            this.formData = {
                id: userInfo.value.id,
                image: userInfo.value.image,
                name: userInfo.value.name,
                full_name: userInfo.value.full_name,
                gender: userInfo.value.gender,
                cellphone: userInfo.value.cellphone,
                email: userInfo.value.email,
                address: userInfo.value.user_address,
                post_code: userInfo.value.user_post_code,
            }
            console.log(this.formData);
        },
        sendData() {
            console.log(this.formData);
            // this.formData.post('/user/update', {
            //     onSuccess: (response) => {
            //         useAuthStore().setUser(response);
            //     },
            //     onError: (error) => {
            //         console.log(error);
            //     }
            // });
            // console.log(useAuthStore().user);
        },
    },
    persist: true
});
