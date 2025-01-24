import { ref, onMounted, mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderStyle, ssrRenderList, ssrRenderAttr, ssrRenderComponent } from "vue/server-renderer";
import _sfc_main$1 from "./svg-component-1aWPQAJr.js";
const _sfc_main = {
  __name: "Slider1",
  __ssrInlineRender: true,
  props: ["slider1Data"],
  setup(__props) {
    const props = __props;
    const X = ref(0);
    const slide = ref(0);
    const translation = ref(0);
    const drag = ref(false);
    const interval = ref(5e3);
    const sliderWith = ref();
    onMounted(() => {
      sliderWith.value = document.getElementById("bt_slider_parent").clientWidth / 16;
    });
    const slider_show = (movement = "no") => {
      if (movement === "forward") {
        slide.value < props.slider1Data.length - 1 ? slide.value++ : slide.value = 0;
      } else if (movement === "backward") {
        slide.value > 0 ? slide.value-- : slide.value = props.slider1Data.length - 1;
      }
      translation.value = slide.value * sliderWith.value;
    };
    document.addEventListener("mouseup", function(event) {
      drag.value = false;
      if (!event.target.classList.contains("slider1")) {
        mouse_upd(event);
        document.getElementById("slider").style.transform = "translateX(" + slide.value * sliderWith.value + "rem)";
      }
    });
    const mouse_upd = (event) => {
      document.getElementById("slider").style.transitionProperty = "all";
      if (drag.value) {
        if (X.value + sliderWith.value * 16 / 10 < event.pageX)
          slider_show("forward");
        else if (event.pageX + sliderWith.value * 16 / 10 < X.value)
          slider_show("backward");
        document.getElementById("slider").style.transform = "translateX(" + slide.value * sliderWith.value + "rem)";
        timer.value = setInterval(slider_show, interval.value, "forward");
        drag.value = false;
      }
    };
    const timer = ref(setInterval(slider_show, interval.value, "forward"));
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({
        id: "bt_slider_parent",
        class: "slider1 mx-auto relative mt-1 rounded-2xl w-[20rem] h-40 overflow-hidden cursor-pointer sm:w-[30rem] sm:h-48 md:w-[40rem] md:h-52 lg:w-[60rem] lg:h-80 xl:w-[80rem] xl:h-96"
      }, _attrs))}><div id="slider" class="flex w-fit h-96 duration-500" style="${ssrRenderStyle(`transform: translateX(${translation.value}rem)`)}"><!--[-->`);
      ssrRenderList(props.slider1Data, (item) => {
        _push(`<span class="slider-pages"><img class="slider1 size-full select-none"${ssrRenderAttr("src", item)} alt=""></span>`);
      });
      _push(`<!--]--></div><div class="slider1 flex justify-between items-center w-full px-4 absolute top-16 sm:top-20 md:top-24 lg:top-32 xl:top-40"><div class="slider-button">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "chev-right",
        class: "size-4 sm:size-5 lg:size-8 xl:size-10"
      }, null, _parent));
      _push(`</div><div class="slider-button">`);
      _push(ssrRenderComponent(_sfc_main$1, {
        name: "chev-left",
        class: "size-4 sm:size-5 lg:size-8 xl:size-10"
      }, null, _parent));
      _push(`</div></div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Components/Slider1.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
