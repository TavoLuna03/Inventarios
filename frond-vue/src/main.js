import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.config.productionTip = false
Vue.use(VueRouter)

import Dashboard from './components/Dashboard.vue'
import Categories from './components/Categories.vue'
import Products from './components/Products.vue'
import Purchases from './components/Purchases.vue'
import Auth from '@okta/okta-vue'

Vue.use(Auth, {
  issuer: 'https://uniminuto-edu.okta.com',
  client_id: '0oap61pdyAGX1WvZC356',
  redirect_uri: 'http://localhost:8080/implicit/callback',
  scope: 'openid profile email'
})

const routes = [
  { path: '/categories', component: Categories },
  { path: '/products', component: Products },
  { path: '/purchase', component: Purchases },
]

const router = new VueRouter({
  mode: 'history',
  routes
})

new Vue({
  router,
  render: h => h(Dashboard)
}).$mount('#app')
