import {defineStore} from "pinia";

export const useSearchStore = defineStore('search', {
    state: () => ({
        Products: null,
        categories: null,
        brands: null,
        attributes: null,
    }),
    actions: {
        async setData() {

        }
    },
    persist: true,
})
