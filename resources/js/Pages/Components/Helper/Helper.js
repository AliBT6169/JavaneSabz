import {ref} from "vue";

const connectUsModalVisibility = ref(false);
const profileSidebar = ref(false);
const profileSidebarCloser = (event) => {
    if (!event.target.classList.contains("SidebarCloser"))
        profileSidebar.value = false;
    console.log(event.target);
}
const profileComponent = ref();

export {
    connectUsModalVisibility,
    profileSidebar,
    profileComponent,
    profileSidebarCloser,
}
