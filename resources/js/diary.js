require('./bootstrap');

import Vue from 'vue'
import App from "./diary.vue";

new Vue({
  render: h => h(App)
}).$mount("#vue_diary");
