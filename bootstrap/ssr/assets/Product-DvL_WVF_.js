import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderAttr, ssrInterpolate, ssrRenderComponent } from "vue/server-renderer";
import _sfc_main$1 from "./svg-component-1aWPQAJr.js";
const _sfc_main = {
  __name: "Product",
  __ssrInlineRender: true,
  props: ["image", "name", "special"],
  setup(__props) {
    const props = __props;
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "relative group overflow-hidden flex w-fit rounded-lg shadow-sm hover:shadow-md hover:shadow-slate-500 duration-300 cursor-pointer px-4 bg-defaultColor6 py-6 flex-col items-center gap-4" }, _attrs))}><div class="size-32 rounded-lg overflow-hidden md:size-40"><img${ssrRenderAttr("src", props.image)} alt="" class="size-full"></div><div class="flex justify-center w-full items-center"><h3 class="">${ssrInterpolate(props.name)}</h3></div><div class="w-full flex lg:justify-between items-center flex-col gap-2 lg:flex-row"><span class="text-defaultColor">800,000 تومان</span><span class="flex justify-between w-full lg:w-fit lg:block">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "cart",
        class: "size-7 duration-500 hover:translate-x-2 hover:text-defaultColor"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        title: "افزودن به علاقه مندی",
        name: "like",
        class: "size-7 hover:fill-red-500 fill-transparent text-red-500 duration-500 lg:hidden"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        title: "مشاهده محصول",
        name: "show",
        class: "size-7 hover:text-defaultColor duration-500 lg:hidden"
      }, null, _parent));
      _push(`</span></div><div class="absolute hidden top-0 bg-defaultColor4 p-2 -left-10 flex-col duration-500 items-center group-hover:left-0 rounded-lg lg:flex">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        title: "افزودن به علاقه مندی",
        name: "like",
        class: "size-6 hover:fill-red-500 fill-transparent text-red-500 duration-500"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        title: "مشاهده محصول",
        name: "show",
        class: "size-6 hover:text-defaultColor duration-500"
      }, null, _parent));
      _push(`</div>`);
      if (props.special === true) {
        _push(`<div class="absolute top-0 right-0 py-5 rounded-b-full bg-red-600 text-slate-200"><p class="-rotate-90 mr-0.5">ویژه</p></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`</div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/Product.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
