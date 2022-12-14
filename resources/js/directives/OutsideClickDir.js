
export default {
  install: (app) => {


    app.directive('click-outside', {
      bind: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
          // Here I check that click was outside the el and his children
          if (!(el == event.target || el.contains(event.target))) {
            vnode.context[binding.expression](event);
          }
        };
        document.body.addEventListener('click', el.clickOutsideEvent);
      },
      unbind: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent);
      },
    });
  }

};