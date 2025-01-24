import { ref, onMounted, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderAttr, ssrRenderComponent } from "vue/server-renderer";
import { _ as _imports_0 } from "./logo1-CXG6V-n9.js";
import _sfc_main$1 from "./svg-component-1aWPQAJr.js";
const _sfc_main = {
  __name: "intro",
  __ssrInlineRender: true,
  setup(__props) {
    const isVisible = ref(true);
    onMounted(() => {
      setTimeout(() => {
        isVisible.value = false;
      }, 2700);
    });
    return (_ctx, _push, _parent, _attrs) => {
      if (isVisible.value) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "top-0 bg-slate-800 bg-opacity-80 z-50 w-screen h-full absolute flex items-center duration-1000 ease-in introView sm:justify-center" }, _attrs))}><div class="flex items-center gap-1 justify-center text-white"><img${ssrRenderAttr("src", _imports_0)} class="size-28 sm:size-52" alt=""><div class="w-0.5 h-10 bg-white rounded-full sm:w-2 sm:h-24"></div><div class="flex gap-1 flex-col"><div class="font-[1000] text-lg flex items-center justify-center sm:text-2xl"> به فروشگاه جوانه سبز خوش آمدید `);
        _push(ssrRenderComponent(_sfc_main$1, {
          name: "like",
          class: "fill-none text-red-500 size-12"
        }, null, _parent));
        _push(`</div><div class="text-slate-500 text-sm sm:text-xl">دوست مهربان کشاورز ها</div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/intro.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
