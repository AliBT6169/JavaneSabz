import '../css/app.css';
import './bootstrap';
import Toast, {POSITION} from "vue-toastification";
import "vue-toastification/dist/index.css";
import {createInertiaApp} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createApp, h} from 'vue';
import {createPinia} from "pinia";
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
import AOS from 'aos';
import 'aos/dist/aos.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia();

pinia.use(piniaPluginPersistedstate);
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(Toast,{
                position: POSITION.TOP_CENTER,
                timeout: 3000,
                closeOnClick: true,
                pauseOnFocusLoss: true,
                pauseOnHover: true,
                draggable: false,
                draggablePercent: 0.6,
                showCloseButtonOnHover: false,
                closeButton: "button",
                icon: true,
                rtl: true,
                filterBeforeCreate: (toast, toasts) => {
                    if (toasts.filter(
                        t => t.type === toast.type
                    ).length !== 0) {
                        return false;
                    }
                    return toast;
                }
            })
            .mount(el);
    },
    progress: {
        color: 'greenyellow',
    },
});

AOS.init({
    duration: 700,
    easing: "ease-in-out",
    offset: 200,
    delay: 200,
    once: true
});

