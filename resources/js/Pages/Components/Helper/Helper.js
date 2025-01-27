import {ref} from "vue";
import ShowProfile from "@/Pages/Profile/Pages/ShowProfile.vue";

const connectUsModalVisibility = ref(false);
const profileSidebar = ref(false);
const profileComponent = ref();

export {
    connectUsModalVisibility,
    profileSidebar,
    profileComponent,
}
