import {useToast} from "vue-toastification";
import {defineStore} from "pinia";
import {ref} from "vue";

const toast = useToast();
export const useIndexStore = defineStore('index', {
    state: () => ({
        Products: null,
        ProductShowData: null,
        modal: false,
        Settings: {
            type: Object,
        }
    }),
    actions: {
        setData(data) {
            this.Products = data;
        },
        setSetting(setting) {
            this.Settings = setting;
        },
        setProductData(data) {
            this.ProductShowData = data;
        },
        async productShow(id) {
            const data = ref();
            await axios.get(route('getProductData', {'id': id})).then((res) => {
                data.value = res.data;
            }).catch((err) => {
                data.value = err;
            });
            return data.value
        },
        async updateProductData() {
            await axios.get(route('getProductData', this.ProductShowData.data.id)).then((res) => {
                this.ProductShowData = res.data;
                console.log(this.ProductShowData)
            }).catch((err) => {
                console.log(err)
            })
        },
    },
    persist: true
});
