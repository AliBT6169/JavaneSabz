import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderAttr, ssrRenderComponent, ssrRenderStyle } from "vue/server-renderer";
import { _ as _imports_0 } from "./logo1-CXG6V-n9.js";
import _sfc_main$1 from "./svg-component-1aWPQAJr.js";
const _sfc_main = {
  __name: "Footer",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "w-screen bg-defaultColor7 flex justify-center items-center rounded-t-[8rem] overflow-hidden" }, _attrs))}><div class="w-[80rem] items-center md:items-start md:justify-around flex flex-col text-white md:flex-row"><div class="flex flex-col gap-2 h-full"><div class="flex duration-300 items-center cursor-pointer gap-2 border-b-2 border-defaultColor5"><img${ssrRenderAttr("src", _imports_0)} alt="جوانه سبز" class="size-20"><h3 class="text-2xl font-black text-defaultColor5">جوانه سبز</h3></div><p class="w-60"> فروشگاه جوانه سبز در تلاش است تا بهترین خود را برای کشاورزان محترم بگذارد تا همیشه بتوانند سود خوبی از زمین های زراعی و باغ های خود داشته باشند خاک پای کشاورزان <span class="text-defaultColor5"> (علیرضا باباتبار) </span></p></div><div class="flex flex-col gap-2 h-full"><div class="flex border-b-2 border-defaultColor5 justify-center items-center"><div class="size-20 flex items-center">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "about",
        class: "size-8"
      }, null, _parent));
      _push(`</div><p class="text-xl translate-x-10 font-black">اطلاعات</p></div><div class="flex duration-300 items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "about",
        class: "size-5"
      }, null, _parent));
      _push(`<h3 class="">درباره ما</h3></div><div class="flex duration-300 items-center cursor-pointer gap-2 hover:-translate-x-2 hover:text-defaultColor5"><a rel="stylesheet" href="tel:09123456789">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "tell",
        title: "09123456789",
        class: "size-5"
      }, null, _parent));
      _push(`</a><h3 class="">تماس با ما</h3></div><div class="flex flex-col gap-3"><div class="flex duration-300 items-center gap-2">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "connection",
        class: "size-5"
      }, null, _parent));
      _push(`<h3 class="">پل های ارتباطی :</h3></div><div class="flex gap-2">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "telegram",
        class: "footer-connection-svg size-[30px]"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "instagram",
        class: "footer-connection-svg size-[30px]"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "whatsapp",
        class: "footer-connection-svg size-7"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "tell",
        class: "footer-connection-svg size-[30px]"
      }, null, _parent));
      _push(`</div></div></div><div class="flex flex-col gap-2 h-full"><div class="flex border-b-2 border-defaultColor5 justify-center items-center"><div class="size-20 flex items-center">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "location",
        class: "size-8"
      }, null, _parent));
      _push(`</div><p class="text-xl translate-x-10 font-black">موقعیت مکانی</p></div><div class=""><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d205.92511102483456!2d52.77588788202066!3d36.650352865990975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f857d39956460cb%3A0xd35d50893e1ab96f!2z2LPZhdmI2YUg2qnYtNin2YjYsdiy24wg2KzZiNin2YbZhyDYs9io2LIg2LTZhdin2YQ!5e0!3m2!1sen!2s!4v1736097896290!5m2!1sen!2s" width="200" height="150" style="${ssrRenderStyle({ "border": "none" })}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div></div><div class="h-28 md:hidden"></div></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Parts/Footer.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
