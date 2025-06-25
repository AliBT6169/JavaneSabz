import {defineStore} from "pinia";

export const useAdminStore = defineStore('admin', {
    state: () => ({
        SideBar: true,
        Page: 'AdminDashboard',
        PageIndexTop: 16,
    }),
    actions: {
        sideBarSelector(name, index) {
            this.Page = name;
            this.PageIndexTop = (index - 1) * 80 + 16;
        },
        logout() {
            this.SideBar = true;
            this.Page = 'AdminDashboard';
            this.PageIndexTop = 16;
        }
    },
    persist: true,
});
