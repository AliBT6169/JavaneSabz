import {defineStore} from "pinia";

export const useAdminStore = defineStore('admin', {
    state: () => ({
        SideBar: true,
    }),
    actions: {},
})
