require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import gv from './mixins/globalValiables'
import HeaderComponent from "./components/HeaderComponent";
import HeaderNotLoginComponent from "./components/HeaderNotLoginComponent";
import DiaryListComponent from "./components/DiaryListComponent";
import DiaryCreateComponent from "./components/DiaryCreateComponent";
import DiaryShowComponent from "./components/DiaryShowComponent";
import DiaryEditComponent from "./components/DiaryEditComponent";
import cognito from './cognito'
import Login from './components/Login'
import Signup from './components/Signup'
import Confirm from './components/Confirm'

Vue.use(VueRouter);
Vue.mixin(gv);

const requireAuth = (to, from, next) => {
  cognito.isAuthenticated()
    .then(session => {
      next()
    })
    .catch(session => {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    })
}

const logout = (to, from, next) => {
  cognito.logout()
  next('/login')
}

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/diary/list'
        },
        {
            path: '/diary/list',
            name: 'diary.list',
            component: DiaryListComponent,
            beforeEnter: requireAuth
        },
        {
            path: '/diary/create/:date',
            name: 'diary.create',
            component: DiaryCreateComponent,
            props: true,
            beforeEnter: requireAuth
        },
        {
            path: '/diary/:diaryId',
            name: 'diary.show',
            component: DiaryShowComponent,
            props: true,
            beforeEnter: requireAuth
        },
        {
            path: '/diary/:diaryId/:date/edit',
            name: 'diary.edit',
            component: DiaryEditComponent,
            props: true,
            beforeEnter: requireAuth
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/singup',
            name: 'Signup',
            component: Signup
        },
        {
            path: '/confirm',
            name: 'Confirm',
            component: Confirm
        },
        {
            path: '/logout',
            name: 'logout',
            beforeEnter: logout
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

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  cognito,
  components: { HeaderComponent, HeaderNotLoginComponent },
  computed: {
    headerComponent() {
      switch(this.$route.path) {
        case '/login':
        case '/singup':
        case '/confirm':
        case '/logout':
          return 'HeaderNotLoginComponent';
        default:
          return 'HeaderComponent';
      }
    }
  }
});
