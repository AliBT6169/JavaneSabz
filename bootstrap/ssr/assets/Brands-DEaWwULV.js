import { ref, onMounted, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderList, ssrRenderAttr } from "vue/server-renderer";
const _sfc_main = {
  __name: "Brands",
  __ssrInlineRender: true,
  props: ["brandsData"],
  setup(__props) {
    const props = __props;
    const dragging = ref(false);
    const slider = ref();
    ref();
    document.addEventListener("mouseup", function(e) {
      dragging.value = false;
    });
    onMounted(() => {
      slider.value = document.querySelector("#brands");
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({
        id: "brands",
        class: "mx-auto overflow-x-scroll"
      }, _attrs))}><div class="flex w-fit text-xs gap-4 mt-4 py-5"><!--[-->`);
      ssrRenderList(props.brandsData, (item) => {
        _push(`<div class="brand-list"><img${ssrRenderAttr("src", item)} alt="" class="brands-image"></div>`);
      });
      _push(`<!--]--></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/Brands.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
