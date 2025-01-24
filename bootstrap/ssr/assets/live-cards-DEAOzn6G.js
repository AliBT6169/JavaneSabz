import { ref, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderAttr } from "vue/server-renderer";
const _sfc_main = {
  __name: "live-cards",
  __ssrInlineRender: true,
  props: ["imageURL", "title"],
  setup(__props) {
    const props = __props;
    const pointer_X = ref(0);
    const pointer_Y = ref(0);
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({
        class: "flex size-full justify-center duration-100 items-center cursor-pointer rounded-xl overflow-hidden",
        style: `transform: perspective(1000px) rotateY(${pointer_X.value}deg) rotateX(${pointer_Y.value}deg)`
      }, _attrs))}><img class="size-full"${ssrRenderAttr("src", props.imageURL)}${ssrRenderAttr("alt", props.title)}></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/live-cards.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
