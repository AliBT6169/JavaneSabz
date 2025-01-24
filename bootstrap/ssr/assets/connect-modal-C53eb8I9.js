import { ref, onMounted, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderClass, ssrRenderComponent } from "vue/server-renderer";
import _sfc_main$1 from "./Input-BT1-DKBtzxNw.js";
import _sfc_main$2 from "./Button-BT1-CZtJGTRD.js";
const connectUsModalVisibility = ref(false);
const _sfc_main = {
  __name: "connect-modal",
  __ssrInlineRender: true,
  setup(__props) {
    const connectUsFormVisibility = ref(false);
    onMounted(() => {
      setTimeout(() => {
        connectUsFormVisibility.value = true;
      }, 100);
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "h-screen w-screen fixed z-20 top-0 left-0 bg-slate-800 bg-opacity-50 flex items-center justify-center" }, _attrs))}><div class="${ssrRenderClass([{ "!visible !translate-y-0 !opacity-100": connectUsFormVisibility.value }, "invisible opacity-0 border-2 border-defaultColor5 -translate-y-96 h-fit w-72 rounded-xl bg-slate-800 lg:bg-opacity-50 lg:dark:bg-opacity-50 py-4 lg:dark:hover:bg-opacity-100 transition-all duration-500 lg:hover:bg-opacity-100 md:w-96"])}"><form class="size-full p-4 items-center gap-2 flex flex-col"><div class="text-lg font-bold text-defaultColor5 border-x-4 rounded-2xl p-1 border-defaultColor">برای ما پیام بفرستید </div>`);
      _push(ssrRenderComponent(_sfc_main$1, { "label-text": "نام و نام خانوادگی:" }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, { "label-text": "شماره همراه:" }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        "label-text": "پیام:",
        "multi-line": "true"
      }, null, _parent));
      _push(`<div class="flex w-full justify-end gap-2 items-center">`);
      _push(ssrRenderComponent(_sfc_main$2, {
        "button-text": "ارسال",
        "buton-type": "submit"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$2, {
        "button-text": "لغو",
        "button-type": "reset",
        onClick: ($event) => connectUsModalVisibility.value = false
      }, null, _parent));
      _push(`</div></form></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/connect-modal.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const connectModal = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main
}, Symbol.toStringTag, { value: "Module" }));
export {
  _sfc_main as _,
  connectModal as a,
  connectUsModalVisibility as c
};
