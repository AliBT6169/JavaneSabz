import { ref, unref, withCtx, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderList, ssrRenderAttr, ssrRenderClass } from "vue/server-renderer";
import { _ as _imports_0$1 } from "./logo1-CXG6V-n9.js";
import _sfc_main$1 from "./svg-component-1aWPQAJr.js";
import { useDark, useToggle } from "@vueuse/core";
import { Link } from "@inertiajs/vue3";
import { c as connectUsModalVisibility, _ as _sfc_main$2 } from "./connect-modal-C53eb8I9.js";
import "./Input-BT1-DKBtzxNw.js";
import "./Button-BT1-CZtJGTRD.js";
const _imports_0 = "/build/assets/tootfarangi-DUpkI22u.jpg";
const _imports_1 = "/build/assets/fertilizer-CoG6aYv7.jpg";
const _imports_2 = "/build/assets/farm-CSifiv86.jpg";
const _sfc_main = {
  __name: "navigation",
  __ssrInlineRender: true,
  setup(__props) {
    const magic_mobile_nav = ref(false);
    const info_mobile_nav = ref(false);
    const isDark = useDark();
    useToggle(isDark);
    document.addEventListener("click", () => {
      magic_mobile_nav.value = false;
      info_mobile_nav.value = false;
      connectUsModalVisibility.value = false;
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[--><div class="mx-auto sticky top-2 z-10 hidden md:block md:w-full"><div class="w-full px-2 flex justify-between items-center rounded-full z-10 rounded-tl-md bg-defaultColor h-14 text-slate-100 lg:px-6"><div class="flex items-center h-full gap-2 lg:gap-4">`);
      _push(ssrRenderComponent(unref(Link), { href: "/" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="header-items"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, {
              name: "home",
              title: "صفحه اصلی جوانه سبز",
              class: "size-7"
            }, null, _parent2, _scopeId));
            _push2(`<h1 class=""${_scopeId}>خانه</h1></div>`);
          } else {
            return [
              createVNode("div", { class: "header-items" }, [
                createVNode(_sfc_main$1, {
                  name: "home",
                  title: "صفحه اصلی جوانه سبز",
                  class: "size-7"
                }),
                createVNode("h1", { class: "" }, "خانه")
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<div class="separate"></div><div class="relative group"><div class="header-items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "strawberry",
        class: "size-5"
      }, null, _parent));
      _push(`<h1 class="">محصولات</h1></div><div class="header-item-lists"><div class="mega-tab-items"><div class="relative overflow-hidden p-4 hover:overflow-visible"><div class="mega-tab-menu-items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "bud",
        class: "size-6"
      }, null, _parent));
      _push(`<h2 class="">بوته ها</h2></div><div class="mega-tab-menu-list top-0"><div class="text-nowrap w-fit flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6"><p class="border-r-4 pr-1 border-defaultColor font-bold">بوته های تابستانه</p><!--[-->`);
      ssrRenderList(15, (index) => {
        _push(`<p class="mega-tab-menu-list-items">توت فرنگی</p>`);
      });
      _push(`<!--]--><p class="border-r-4 pr-1 border-defaultColor font-bold">بوته های زمستانه</p><!--[-->`);
      ssrRenderList(21, (index) => {
        _push(`<p class="mega-tab-menu-list-items">انگور تابستونی</p>`);
      });
      _push(`<!--]--><p class="border-r-4 pr-1 border-defaultColor font-bold">بوته های بهاره</p><!--[-->`);
      ssrRenderList(3, (index) => {
        _push(`<p class="mega-tab-menu-list-items">انجیر سیاه </p>`);
      });
      _push(`<!--]--><p class="border-r-4 pr-1 border-defaultColor font-bold">بوته های پاییزه</p><!--[-->`);
      ssrRenderList(11, (index) => {
        _push(`<p class="mega-tab-menu-list-items">شاه توت</p>`);
      });
      _push(`<!--]--></div><div class="w-52 h-full overflow-hidden"><img${ssrRenderAttr("src", _imports_0)} class="size-full hidden lg:block" alt=""></div></div></div></div><div class="mega-tab-items"><div class="relative overflow-hidden p-4 hover:overflow-visible"><div class="mega-tab-menu-items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "fertilizer",
        class: "size-6"
      }, null, _parent));
      _push(`<h2 class="">کود ها</h2></div><div class="mega-tab-menu-list -top-[58px]"><div class="text-nowrap flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6"><p class="border-r-4 pr-1 border-blue-600 font-bold">شیمیایی</p><!--[-->`);
      ssrRenderList(7, (index) => {
        _push(`<p class="mega-tab-menu-list-items">کود سفید</p>`);
      });
      _push(`<!--]--><p class="border-r-4 pr-1 border-blue-600 font-bold">ارگانیک</p><!--[-->`);
      ssrRenderList(10, (index) => {
        _push(`<p class="mega-tab-menu-list-items">کود سیاه</p>`);
      });
      _push(`<!--]--></div><div class="w-72 h-full overflow-hidden"><img${ssrRenderAttr("src", _imports_1)} class="size-full hidden lg:block" alt=""></div></div></div></div><div class="mega-tab-items"><div class="relative overflow-hidden p-4 hover:overflow-visible"><div class="mega-tab-menu-items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "up",
        class: "size-6"
      }, null, _parent));
      _push(`<h2 class="">تقویتی</h2></div><div class="mega-tab-menu-list -top-[115px]"><div class="text-nowrap flex flex-col flex-wrap h-full gap-x-8 gap-y-2 p-6"><p class="border-r-4 pr-1 border-blue-600 font-bold">شیمیایی</p><!--[-->`);
      ssrRenderList(7, (index) => {
        _push(`<p class="mega-tab-menu-list-items">کود سفید</p>`);
      });
      _push(`<!--]--><p class="border-r-4 pr-1 border-blue-600 font-bold">ارگانیک</p><!--[-->`);
      ssrRenderList(10, (index) => {
        _push(`<p class="mega-tab-menu-list-items">کود سیاه</p>`);
      });
      _push(`<!--]--></div><div class="w-96 h-full overflow-hidden"><img${ssrRenderAttr("src", _imports_2)} class="size-full hidden lg:block" alt=""></div></div></div></div></div></div><div class="separate"></div><div class="header-items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "book",
        title: "آموزش",
        class: "size-5 lg:size-6"
      }, null, _parent));
      _push(`<h1 class="">آموزش ها</h1></div><div class="separate"></div>`);
      _push(ssrRenderComponent(unref(Link), { href: "/درباره ما" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="header-items"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, {
              name: "about",
              title: "درباره جوانه سبز",
              class: "size-5 lg:size-6"
            }, null, _parent2, _scopeId));
            _push2(`<h1 class=""${_scopeId}>درباره ما</h1></div>`);
          } else {
            return [
              createVNode("div", { class: "header-items" }, [
                createVNode(_sfc_main$1, {
                  name: "about",
                  title: "درباره جوانه سبز",
                  class: "size-5 lg:size-6"
                }),
                createVNode("h1", { class: "" }, "درباره ما")
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<div class="separate"></div><div class="header-items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "tell",
        title: "تماس با جوانه سبز",
        class: "size-5 lg:size-6"
      }, null, _parent));
      _push(`<h1 class="">تماس با ما</h1></div></div><div class="flex gap-2 text-defaultColor4 items-center lg:gap-4"><h2 class="header-connection-svg after:left-[-14px] hover:after:content-[&#39;تلگرام&#39;]">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "telegram",
        title: "جوانه سبز در تلگرام",
        class: "size-8"
      }, null, _parent));
      _push(`</h2><h2 class="header-connection-svg after:left-[-29px] hover:after:content-[&#39;اینستاگرام&#39;]">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "instagram",
        title: "جوانه سبز در اینستاگرام",
        class: "size-8"
      }, null, _parent));
      _push(`</h2><h2 class="header-connection-svg after:left-[-19px] hover:after:content-[&#39;واتساپ&#39;]">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "whatsapp",
        title: "جوانه سبز در واتساپ",
        class: "size-7"
      }, null, _parent));
      _push(`</h2></div></div></div><div class="w-full mx-auto fixed bottom-0 px-10 items-center z-20 h-16 bg-opacity-70 text-defaultColor rounded-t-full bg-defaultColor flex justify-between md:hidden"><div class="home_mobile_navigation_items relative">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "magic",
        class: "size-[80%] sm:size-10"
      }, null, _parent));
      _push(`<div class="${ssrRenderClass(["absolute w-fit flex gap-3 p-4 items-center -right-12 top-10 duration-500 ease-out opacity-0 text-black", { "opacity-100 !-top-20": magic_mobile_nav.value }])}"><div class="bg-slate-700 text-black bg-opacity-50 p-1 rounded-lg">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "moon2",
        class: "size-7"
      }, null, _parent));
      _push(`</div><div class="bg-slate-700 bg-opacity-50 p-1 text-red-600 rounded-lg fill-none -mt-10 hover:fill-red-900">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "like",
        class: "size-7"
      }, null, _parent));
      _push(`</div><div class="bg-slate-700 bg-opacity-50 p-1 text-blue-600 rounded-lg">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "book",
        class: "size-7"
      }, null, _parent));
      _push(`</div></div></div><div class="home_mobile_navigation_items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "cart",
        title: "سبد خرید",
        class: "size-[70%] sm:size-10"
      }, null, _parent));
      _push(`</div>`);
      _push(ssrRenderComponent(unref(Link), { href: "/" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="cursor-pointer flex justify-center items-center duration-500 -mt-10 hover:-translate-y-2"${_scopeId}><img${ssrRenderAttr("src", _imports_0$1)} title="خانه" class="size-20 sm:size-32" alt=""${_scopeId}></div>`);
          } else {
            return [
              createVNode("div", { class: "cursor-pointer flex justify-center items-center duration-500 -mt-10 hover:-translate-y-2" }, [
                createVNode("img", {
                  src: _imports_0$1,
                  title: "خانه",
                  class: "size-20 sm:size-32",
                  alt: ""
                })
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<div class="home_mobile_navigation_items">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "strawberry",
        title: "محصولات",
        class: "size-[70%] sm:size-10"
      }, null, _parent));
      _push(`</div><div class="home_mobile_navigation_items relative">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "about",
        class: "size-[70%] sm:size-10"
      }, null, _parent));
      _push(`<div class="${ssrRenderClass(["absolute w-fit flex gap-3 p-4 items-center -right-11 top-10 duration-500 ease-out opacity-0 text-black", { "opacity-100 !-top-20": info_mobile_nav.value }])}">`);
      _push(ssrRenderComponent(unref(Link), { href: "/درباره ما" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="bg-slate-700 bg-opacity-50 p-1 text-gray-200 rounded-lg fill-none hover:fill-red-900"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, {
              name: "about",
              class: "size-7"
            }, null, _parent2, _scopeId));
            _push2(`</div>`);
          } else {
            return [
              createVNode("div", { class: "bg-slate-700 bg-opacity-50 p-1 text-gray-200 rounded-lg fill-none hover:fill-red-900" }, [
                createVNode(_sfc_main$1, {
                  name: "about",
                  class: "size-7"
                })
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<div class="bg-slate-700 bg-opacity-50 p-1 text-defaultColor rounded-lg">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "tell",
        class: "size-7"
      }, null, _parent));
      _push(`</div></div></div></div>`);
      if (unref(connectUsModalVisibility)) {
        _push(ssrRenderComponent(_sfc_main$2, null, null, _parent));
      } else {
        _push(`<!---->`);
      }
      _push(`<!--]-->`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/navigation.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
