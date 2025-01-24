import { mergeProps, unref, withCtx, createVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderAttr, ssrRenderStyle } from "vue/server-renderer";
import _sfc_main$2 from "./navigation-pHk-5lHw.js";
import _sfc_main$1 from "./Header-BOjZ1_7z.js";
import _sfc_main$4 from "./Footer--Owl_BSK.js";
import _sfc_main$3 from "./svg-component-1aWPQAJr.js";
import { Link } from "@inertiajs/vue3";
import "./logo1-CXG6V-n9.js";
import "@vueuse/core";
import "./connect-modal-C53eb8I9.js";
import "./Input-BT1-DKBtzxNw.js";
import "./Button-BT1-CZtJGTRD.js";
const _imports_0 = "/build/assets/mojtaba-COE4w6DZ.jpg";
const _imports_1 = "/build/assets/owner-BTqcdb-V.jpg";
const _sfc_main = {
  __name: "About-Us",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mx-auto flex flex-col gap-10 items-center w-[20rem] sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]" }, _attrs))}>`);
      _push(ssrRenderComponent(_sfc_main$1, null, null, _parent));
      _push(ssrRenderComponent(_sfc_main$2, null, null, _parent));
      _push(`<div class="w-full flex"><div class="flex items-center w-fit gap-2 px-4">`);
      _push(ssrRenderComponent(unref(Link), { href: "/" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor"${_scopeId}>خانه </span>`);
          } else {
            return [
              createVNode("span", { class: "hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor" }, "خانه ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(_sfc_main$3, {
        name: "next",
        class: "size-3"
      }, null, _parent));
      _push(`<span class="hover:text-defaultColor5 duration-500 cursor-pointer border-b-2 border-defaultColor">درباره ما</span></div></div><div class="flex flex-col mx-auto items-center w-full gap-5 p-6 rounded-xl border-2 border-defaultColor"><span class="w-full p-5 rounded-2xl bg-gradient-to-b from-defaultColor2 to-defaultColor5 2xl:p-10"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد. </span><div class="flex w-full justify-center gap-4 mt-4 flex-col md:flex-row"><div class="relative w-full h-96 flex justify-center items-center rounded-xl p-5 bg-defaultColor5 mx-auto overflow-hidden"><img${ssrRenderAttr("src", _imports_0)} alt="" class="size-full rounded-2xl"><div class="absolute bottom-8 p-2 rounded-lg bg-defaultColor5 animate-bounce"> فروشگاه جوانه سبز از نمای نزدیک </div></div><div class="relative w-full h-96 flex justify-center items-center rounded-xl p-5 bg-defaultColor5 mx-auto overflow-hidden"><img${ssrRenderAttr("src", _imports_1)} alt="" class="size-full rounded-2xl"><div class="absolute bottom-8 p-2 rounded-lg bg-defaultColor5 animate-bounce"> مدیریت : مجتبی میرقربانی </div></div></div><div class="flex flex-col w-full items-start gap-10 justify-between mt-6 rounded-xl border-2 border-defaultColor border-b-0 py-4 lg:flex-row"><div class="flex w-full flex-col items-center gap-2"><div class="text-xl font-black">پل های ارتباطی:</div><div class="flex justify-center gap-2"><a href="#" class="">`);
      _push(ssrRenderComponent(_sfc_main$3, {
        name: "telegram",
        class: "size-11 cursor-pointer duration-300 hover:-translate-y-1"
      }, null, _parent));
      _push(`</a><a href="#" class="">`);
      _push(ssrRenderComponent(_sfc_main$3, {
        name: "whatsapp",
        class: "size-10 cursor-pointer duration-300 hover:-translate-y-1"
      }, null, _parent));
      _push(`</a><a href="#" class="">`);
      _push(ssrRenderComponent(_sfc_main$3, {
        name: "instagram",
        class: "size-11 cursor-pointer duration-300 hover:-translate-y-1 -mt-0.5"
      }, null, _parent));
      _push(`</a><a href="#" class="">`);
      _push(ssrRenderComponent(_sfc_main$3, {
        name: "tell",
        class: "size-10 cursor-pointer duration-300 hover:-translate-y-1"
      }, null, _parent));
      _push(`</a></div></div><div class="flex w-full flex-col justify-center items-center"><span class="font-black text-xl">نشانی:</span><span class="w-60">مازندران-بابلسر-بهنمیر-کیلومتر4بلوار درزیان-ابتدای ورودی روستای پارومحله</span></div><div class="flex flex-col w-full items-center justify-center gap2"><div class="font-bold text-xl">موقعیت نقشه:</div><div class="size-fit overflow-hidden rounded-lg border-2 border-defaultColor5"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d205.92511102483456!2d52.77588788202066!3d36.650352865990975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f857d39956460cb%3A0xd35d50893e1ab96f!2z2LPZhdmI2YUg2qnYtNin2YjYsdiy24wg2KzZiNin2YbZhyDYs9io2LIg2LTZhdin2YQ!5e0!3m2!1sen!2s!4v1736097896290!5m2!1sen!2s" width="200" height="150" style="${ssrRenderStyle({ "border": "none" })}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div></div></div></div>`);
      _push(ssrRenderComponent(_sfc_main$4, null, null, _parent));
      _push(`</div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/About-Us.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
