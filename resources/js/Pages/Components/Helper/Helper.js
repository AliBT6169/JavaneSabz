import {markRaw, ref} from "vue";
import showProfile from "@/Pages/Profile/Pages/ShowProfile.vue";
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Pages/Components/Helper/authStore.js";
import Favorite from "@/Pages/Profile/Pages/Favorite.vue";
import BuyCart from "@/Pages/Profile/Pages/BuyCart.vue";
import ProductShow from "@/Pages/ProductShow.vue";

const show_profile = markRaw(showProfile);
const buyCart = markRaw(BuyCart);
const favorite = markRaw(Favorite);
const productShow = markRaw(ProductShow);

const connectUsModalVisibility = ref(false);
const profileSidebar = ref(false);
const profileComponent = ref(showProfile);
const Modal = ref(false);
const ModalComponent = ref();
const modalSet = (modal) => {
    if (modal === 'ProductShow') {
        Modal.value = !Modal.value;
        ModalComponent.value = productShow;
    } else if (useAuthStore().isAuthenticated) {
        Modal.value = !Modal.value;
        if (modal === 'Favorite')
            ModalComponent.value = favorite;
        else if (modal === 'BuyCart')
            ModalComponent.value = buyCart;
    } else {
        const toast = useToast();
        toast.warning('برای دسترسی باید به حساب کاربری خود وارد شوید')
    }
}
const profileSidebarCloser = (event) => {
    if (!event.target.classList.contains("Sidebar"))
        profileSidebar.value = false;
}

export {
    connectUsModalVisibility,
    profileSidebar,
    profileComponent,
    Modal,
    ModalComponent,
    profileSidebarCloser,
    modalSet,
}
