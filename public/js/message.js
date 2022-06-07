/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/message.js ***!
  \*********************************/
window.addEventListener('DomContentLoaded', function () {
  console.log(uuid);
});
Echo.join("chatroom.".concat(uuid)).here(function (users) {
  console.log(users);
}).joining(function (user) {
  console.log(user.name + ' a rejoint');
}).leaving(function (user) {
  console.log(user.name + ' est parti');
}).listen('MessageSent', function (e) {
  window.livewire.emit('messageSent', e.message);
});
/******/ })()
;