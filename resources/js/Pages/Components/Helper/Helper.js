import {markRaw, ref} from "vue";
import showProfile from "@/Pages/Profile/Pages/ShowProfile.vue";

const show_profile = markRaw(showProfile);

const connectUsModalVisibility = ref(false);
const profileSidebar = ref(false);
const profileComponent = ref(showProfile);
const profileSidebarCloser = (event) => {
    if (!event.target.classList.contains("Sidebar"))
        profileSidebar.value = false;
}

export {
    connectUsModalVisibility,
    profileSidebar,
    profileComponent,
    profileSidebarCloser,
}
