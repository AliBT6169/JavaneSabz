import { ref, onMounted, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderList, ssrRenderComponent } from "vue/server-renderer";
import _sfc_main$1 from "./Product-DvL_WVF_.js";
import "./svg-component-1aWPQAJr.js";
const _sfc_main = {
  __name: "product-slider1",
  __ssrInlineRender: true,
  setup(__props) {
    const productData = ref("../../../../images/products/Emamectin.jpg");
    const dragging = ref(false);
    const slider = ref();
    ref();
    document.addEventListener("mouseup", function(e) {
      dragging.value = false;
    });
    onMounted(() => {
      slider.value = document.querySelector("#product-slider");
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({
        id: "product-slider",
        class: "overflow-scroll w-full py-4 mx-auto select-none"
      }, _attrs))}><div class="text-nowrap w-fit gap-2 flex"><!--[-->`);
      ssrRenderList(10, (item) => {
        _push(ssrRenderComponent(_sfc_main$1, {
          image: productData.value,
          name: "امامکتین بنزوات"
        }, null, _parent));
      });
      _push(`<!--]--></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/product-slider1.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
