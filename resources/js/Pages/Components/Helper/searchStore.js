import {defineStore} from "pinia";

export const useSearchStore = defineStore('search', {
    state: () => ({
        allProducts: null,
        ProductsToShow: null,
        categories: null,
        brands: null,
        attributes: null,
    }),
    actions: {
        async setData(input) {
            await axios(route('ProductSearch', input)).then((response) => {
                this.allProducts = response.data;
                this.ProductsToShow = response.data.slice(0, 10);
            }).catch((error) => {
                this.allProducts = null;
                this.ProductsToShow = null;
            });
        }
    },
    persist: true,
})
