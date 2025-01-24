import { ref, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderList } from "vue/server-renderer";
import _sfc_main$2 from "./Header-BOjZ1_7z.js";
import _sfc_main$9 from "./Footer--Owl_BSK.js";
import _sfc_main$4 from "./Slider1-CRXT7Ij1.js";
import _sfc_main$5 from "./Brands-DEaWwULV.js";
import _sfc_main$8 from "./Product-DvL_WVF_.js";
import _sfc_main$6 from "./product-slider1-DVVz9tVD.js";
import _sfc_main$3 from "./navigation-pHk-5lHw.js";
import _sfc_main$7 from "./live-cards-DEAOzn6G.js";
import _sfc_main$1 from "./intro-BLTTmG7c.js";
import "./logo1-CXG6V-n9.js";
import "./svg-component-1aWPQAJr.js";
import "@vueuse/core";
import "@inertiajs/vue3";
import "./connect-modal-C53eb8I9.js";
import "./Input-BT1-DKBtzxNw.js";
import "./Button-BT1-CZtJGTRD.js";
const _sfc_main = {
  __name: "Index",
  __ssrInlineRender: true,
  setup(__props) {
    const slider1Data = ref([
      "../../../../images/slider/slider%20(1).jpeg",
      "../../../../images/slider/slider%20(2).jpeg",
      "../../../../images/slider/slider%20(3).jpeg",
      "../../../../images/slider/slider%20(4).jpeg",
      "../../../../images/slider/slider%20(5).jpeg",
      "../../../../images/slider/slider%20(6).jpeg",
      "../../../../images/slider/slider%20(7).jpeg",
      "../../../../images/slider/slider%20(8).jpeg"
    ]);
    const brandsData = ref([
      "../../../../images/brands/advanced-nutrients.webp",
      "../../../../images/brands/ardin.webp",
      "../../../../images/brands/argeto.webp",
      "../../../../images/brands/ariashimi.webp",
      "../../../../images/brands/asia-seed.webp",
      "../../../../images/brands/baghbantak.webp",
      "../../../../images/brands/barenbrug.webp",
      "../../../../images/brands/behcam.webp",
      "../../../../images/brands/biobizz.webp",
      "../../../../images/brands/continental-semences.webp"
    ]);
    const productData = ref("../../../../images/products/10640410.webp");
    const liveCardData = ref([
      "../../../../images/farm.jpg",
      "../../../../images/fertilizer.jpg",
      "../../../../images/slider/slider%20(7).jpeg"
    ]);
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "mx-auto flex flex-col gap-10 items-center w-[20rem] sm:w-[30rem] md:w-[40rem] lg:w-[60rem] xl:w-[80rem]" }, _attrs))}>`);
      _push(ssrRenderComponent(_sfc_main$1, null, null, _parent));
      _push(ssrRenderComponent(_sfc_main$2, null, null, _parent));
      _push(ssrRenderComponent(_sfc_main$3, null, null, _parent));
      _push(ssrRenderComponent(_sfc_main$4, { "slider1-data": slider1Data.value }, null, _parent));
      _push(`<div class="w-full mx-auto px-4"><div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0"><div class="flex gap-2"><span class="">برندهای</span><span class="font-black text-defaultColor5">برتر</span></div><div class="flex gap-2 h-2"><span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span><span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span></div></div>`);
      _push(ssrRenderComponent(_sfc_main$5, {
        class: "w-full",
        "brands-data": brandsData.value
      }, null, _parent));
      _push(`</div><div class="w-full mx-auto"><div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0"><div class="flex gap-2"><span class="">کود های</span><span class="font-black text-defaultColor5">تقویتی</span></div><div class="flex gap-2 h-2"><span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span><span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span></div></div>`);
      _push(ssrRenderComponent(_sfc_main$6, { class: "w-full" }, null, _parent));
      _push(`</div><div class="w-full mx-auto"><div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0"><div class="flex gap-2"><span class="">اتفاقات</span><span class="font-black text-defaultColor5">خوب</span></div><div class="flex gap-2 h-2"><span class="w-7/12 rounded-full bg-defaultColor5 h-full"></span><span class="w-4/12 rounded-full bg-defaultColor5 h-full"></span></div></div><div class="mt-6 flex justify-center flex-col items-center gap-2 mx-auto w-full lg:flex-row lg:h-[15rem]">`);
      _push(ssrRenderComponent(_sfc_main$7, {
        "image-u-r-l": liveCardData.value[0],
        title: "مزرعه"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$7, {
        "image-u-r-l": liveCardData.value[1],
        title: "مزرعه"
      }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$7, {
        "image-u-r-l": liveCardData.value[2],
        title: "مزرعه"
      }, null, _parent));
      _push(`</div></div><div class="w-full mx-auto gap-4 flex flex-col"><div class="w-fit mx-auto flex flex-col gap-2 text-4xl md:m-0"><div class="flex gap-2"><span class="">محصولات</span><span class="font-black text-defaultColor5">برتر</span></div><div class="flex gap-2 h-2"><span class="w-1/12 rounded-full bg-defaultColor5 h-full"></span><span class="w-11/12 rounded-full bg-defaultColor5 h-full"></span></div></div><div class="grid grid-cols-minmaxfill gap-4 justify-center mx-auto w-full"><!--[-->`);
      ssrRenderList(15, (item) => {
        _push(ssrRenderComponent(_sfc_main$8, {
          image: productData.value,
          name: "امامکتین بنزوات",
          special: true
        }, null, _parent));
      });
      _push(`<!--]--></div></div>`);
      _push(ssrRenderComponent(_sfc_main$9, { class: "mt-10" }, null, _parent));
      _push(`</div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
