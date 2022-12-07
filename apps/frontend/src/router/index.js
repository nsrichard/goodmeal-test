import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import StoreView from '../views/StoreView.vue'
import CartView from '../views/CartView.vue'
import OrdersView from '../views/OrdersView.vue'
import OrderDetailView from '../views/OrderDetailView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/store/:id',
      name: 'store',
      component: StoreView,
      props: true
    },
    {
      path: '/cart',
      name: 'cart',
      component: CartView,
    },
    {
      path: '/orders',
      name: 'orders',
      component: OrdersView,
    },
    {
      path: '/order/:id',
      name: 'order',
      component: OrderDetailView,
      props: true
    },
  ]
})

export default router
