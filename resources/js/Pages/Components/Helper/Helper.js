import {ref} from "vue";

const connectUsModalVisibility = ref(false);
const profileSidebar = ref(false);
const profileComponent = ref(false);
const profileSidebarCloser = (event) => {
    if (!event.target.classList.contains("Sidebar"))
        profileSidebar.value = false;
    console.log(event.target);
}

export {
    connectUsModalVisibility,
    profileSidebar,
    profileComponent,
    profileSidebarCloser,
}
