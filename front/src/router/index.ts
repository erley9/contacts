import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import FormularioView from '../views/Formulario.vue'
import ListContactView from '../views/ListContactView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginView,
      meta: {
        "requiresAuth":false
      }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      meta: {
        "requiresAuth":false
      }
    },
    {
      path: '/contact/register',
      name: 'contact.register',
      component: FormularioView,
      meta: {
        "requiresAuth":true
      }
    },
    {
      path: '/contact/update/:id',
      name: 'contact.update',
      component: FormularioView,
      props: true,
      meta: {
        "requiresAuth":true
      }
    },
    {
      path: '/contact',
      name: 'contact',
      component: ListContactView,
      props: true,
      meta: {
        "requiresAuth":true
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem("accesstoken") == null) {
      next({ path: '/' })
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router
