import {useToast} from "vue-toastification";
import {defineStore} from "pinia";

const toast = useToast();
export const useIndexStore = defineStore('index', {
    state: () => ({
        Products: null,
    }),
    actions: {
        setData(data) {
            this.Products = data;
        },
    },
    persist: true
});
