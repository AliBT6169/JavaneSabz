import {defineStore} from "pinia";

export const useAdminStore = defineStore('admin', {
    state: () => ({
        SideBar: true,
        Page: 'ss',
        PageIndexTop: 0,
    }),
    actions: {
        sideBarSelector(name, index) {
            this.Page = name;
            this.PageIndexTop = (index-1) * 56 + 16;
        },
    },
})
