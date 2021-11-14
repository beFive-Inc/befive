/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/formcheck.js ***!
  \***********************************/
var formCheck = {
  form: document.querySelector('#check'),
  child: document.querySelectorAll('#check input, #check textarea'),
  el: [],
  btn: document.querySelector('#check button'),
  init: function init() {
    var _this = this;

    this.child.forEach(function (child, index) {
      child.index = index;

      if (child.type == 'hidden' || child.value) {
        _this.el.push([child, true]);
      } else {
        _this.el.push([child, false]);
      }
    });
    this.listener();
  },
  changeEl: function changeEl(child) {
    if (child.value === '') {
      this.el[child.index][1] = false;
    } else {
      this.el[child.index][1] = true;
    }

    this.check();
  },
  check: function check() {
    this.allChecked = this.el.find(function (el) {
      return el[1] === false;
    });
    this.btn.disabled = !!this.allChecked;
  },
  listener: function listener() {
    var _this2 = this;

    this.child.forEach(function (child) {
      child.addEventListener('keyup', function () {
        _this2.changeEl(child);
      });
    });
  }
};

if (formCheck.form) {
  formCheck.init();
}
/******/ })()
;