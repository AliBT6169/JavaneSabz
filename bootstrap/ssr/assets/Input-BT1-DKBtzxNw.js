import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrInterpolate } from "vue/server-renderer";
const _sfc_main = {
  __name: "Input-BT1",
  __ssrInlineRender: true,
  props: ["labelText", "multiLine"],
  setup(__props) {
    const props = __props;
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "w-full h-fit text-sm justify-between items-center text-nowrap flex gap-2 text-white" }, _attrs))}><label class="w-full" for="name">${ssrInterpolate(props.labelText)}</label>`);
      if (!props.multiLine) {
        _push(`<input id="name" type="text" class="text-sm rounded-xl w-full bg-slate-200 text-slate-800">`);
      } else {
        _push(`<!---->`);
      }
      if (props.multiLine) {
        _push(`<textarea class="text-sm rounded-xl w-full bg-slate-200 text-slate-800" cols="30" rows="5"></textarea>`);
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/Form/Input-BT1.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
