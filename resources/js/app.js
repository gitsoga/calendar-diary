require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import HeaderComponent from "./components/HeaderComponent";
import DiaryListComponent from "./components/DiaryListComponent";
import DiaryCreateComponent from "./components/DiaryCreateComponent";
import DiaryShowComponent from "./components/DiaryShowComponent";
import DiaryEditComponent from "./components/DiaryEditComponent";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/diary/list',
            name: 'diary.list',
            component: DiaryListComponent
        },
        {
            path: '/diary/create',
            name: 'diary.create',
            component: DiaryCreateComponent
        },
        {
            path: '/diary/:diaryId',
            name: 'diary.show',
            component: DiaryShowComponent,
            props: true
        },
        {
            path: '/diary/:diaryId/edit',
            name: 'diary.edit',
            component: DiaryEditComponent,
            props: true
        },
    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', HeaderComponent);


new Vue({
  el: '#app',
  router
});
