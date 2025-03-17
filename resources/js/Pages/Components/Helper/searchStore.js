import {defineStore} from "pinia";

export const useSearchStore = defineStore('search', {
    state: () => ({
        Products: null,
        categories: null,
        brands: null,
        attributes: null,
    }),
    actions: {
        async setData(input) {
            await axios(route('ProductSearch',input)).then((response) => {
                this.Products = response.data.productVariations;
            }).catch((error)=>{
                console.log(error.response.data);
            });
            await console.log(this.Products)
        }
    },
})
