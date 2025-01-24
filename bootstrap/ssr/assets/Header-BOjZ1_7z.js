import { mergeProps, unref, withCtx, createVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderAttr } from "vue/server-renderer";
import { _ as _imports_0 } from "./logo1-CXG6V-n9.js";
import _sfc_main$1 from "./svg-component-1aWPQAJr.js";
import { useDark, useToggle } from "@vueuse/core";
import { Link } from "@inertiajs/vue3";
const _sfc_main = {
  __name: "Header",
  __ssrInlineRender: true,
  setup(__props) {
    const isDark = useDark();
    useToggle(isDark);
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<header${ssrRenderAttrs(mergeProps({ class: "w-full" }, _attrs))}><div class="w-fit flex z-20 flex-col mx-auto items-center justify-center md:flex-row md:w-full md:justify-between"><div class="flex items-center gap-1 justify-center">`);
      _push(ssrRenderComponent(unref(Link), {
        href: "/",
        class: ""
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<img${ssrRenderAttr("src", _imports_0)} class="w-24 h10" alt=""${_scopeId}>`);
          } else {
            return [
              createVNode("img", {
                src: _imports_0,
                class: "w-24 h10",
                alt: ""
              })
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<div class="w-2 h-8 border-gray-300 border-r-2"></div><div class="flex gap-1 flex-col"><div class="font-[1000] text-[1rem]"><span class="hidden lg:inline-block">فروشگاه </span> محصولات کشاورزی جوانه سبز </div><div class="text-slate-500 text-xs">دوست مهربان کشاورز ها</div></div></div><div class="xl:w-[20rem] hidden lg:block"><div class="relative w-fit"><input type="text" class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor xl:w-[20rem] sm:[200px] w-[250px] md:w-[150px] h-10 rounded-2xl bg-gray-50 border-gray-200 text-xs lg:text-sm" placeholder="جستجوی محصول"><div class="absolute top-2.5 left-2 cursor-pointer text-slate-200">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "search",
        class: "size-5"
      }, null, _parent));
      _push(`</div></div></div><div class="gap-2 hidden md:flex"><div class="w-fit px-4 shine_animation h-10 rounded-bl-sm rounded-3xl bg-defaultColor flex shadow-sm gap-2 justify-center items-center"><div class="text-defaultColor4">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "cart",
        class: "size-5"
      }, null, _parent));
      _push(`</div><div class="text-xs text-nowrap text-white block">سبد خرید</div><div class="px-2 py-1 mt-0.5 bg-slate-300 rounded-full text-xs">0</div></div>`);
      _push(ssrRenderComponent(unref(Link), {
        href: _ctx.route("dashboard")
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="group transition-colors duration-[400ms] text-sm flex gap-2 bg-white rounded-lg items-center justify-center border shadow-lg border-slate-300 p-2 shine_animation hover:text-white hover:bg-defaultColor lg:px-4"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, {
              name: "person",
              class: "size-5"
            }, null, _parent2, _scopeId));
            _push2(`<div class="text-nowrap hidden lg:block"${_scopeId}>ورود / ثبت نام</div></div>`);
          } else {
            return [
              createVNode("div", { class: "group transition-colors duration-[400ms] text-sm flex gap-2 bg-white rounded-lg items-center justify-center border shadow-lg border-slate-300 p-2 shine_animation hover:text-white hover:bg-defaultColor lg:px-4" }, [
                createVNode(_sfc_main$1, {
                  name: "person",
                  class: "size-5"
                }),
                createVNode("div", { class: "text-nowrap hidden lg:block" }, "ورود / ثبت نام")
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</div><div class="gap-2 items-center hidden md:flex"><div class="size-10 hover:bg-[#FF8A665E] transition-colors duration-[400ms] shine_animation bg-[#f6dfda] flex justify-center items-center rounded-xl"><div class="fill-none text-[#f54f19]">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "like",
        class: "size-6"
      }, null, _parent));
      _push(`</div></div><div class="size-10 flex items-center justify-center hover:bg-slate-400 transition-all rounded-xl bg-slate-300 border-slate-800 shine_animation cursor-pointer">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "moon2",
        class: "size-6",
        title: "دارک مود"
      }, null, _parent));
      _push(`</div></div><div class="flex justify-center gap-4 w-full md:hidden"><div class="z-10 w-60 sm:w-72"><div class="relative"><input type="text" class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor w-full h-10 rounded-2xl bg-gray-50 border-gray-200 text-xs lg:text-sm" placeholder="جستجوی محصول"><div class="absolute top-2.5 left-2 cursor-pointer text-slate-200">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "search",
        class: "size-5"
      }, null, _parent));
      _push(`</div></div></div>`);
      _push(ssrRenderComponent(unref(Link), { href: "/dashboard" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="size-10 flex items-center justify-center hover:bg-blue-400 transition-all rounded-xl bg-blue-300 border-slate-800 shine_animation cursor-pointer" title="ورود/ثبت نام"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, {
              name: "person",
              class: "size-6",
              title: "ورود/ثبت نام"
            }, null, _parent2, _scopeId));
            _push2(`</div>`);
          } else {
            return [
              createVNode("div", {
                class: "size-10 flex items-center justify-center hover:bg-blue-400 transition-all rounded-xl bg-blue-300 border-slate-800 shine_animation cursor-pointer",
                title: "ورود/ثبت نام"
              }, [
                createVNode(_sfc_main$1, {
                  name: "person",
                  class: "size-6",
                  title: "ورود/ثبت نام"
                })
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</div></div><div class="w-full hidden md:block lg:hidden"><div class="relative w-fit mx-auto"><input type="text" class="focus:outline-none focus:ring-transparent transition-colors duration-300 focus:border-defaultColor w-[20rem] h-10 rounded-2xl bg-gray-50 border-gray-200 text-xs lg:text-sm" placeholder="جستجوی محصول"><div class="absolute top-2.5 left-2 cursor-pointer text-slate-200">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "search",
        class: "size-5"
      }, null, _parent));
      _push(`</div></div></div></header>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Parts/Header.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
