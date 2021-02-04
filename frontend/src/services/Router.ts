import Vue from "vue"
import VueRouter from "vue-router"
import Home from "../views/Home.vue"
import Infos from "@/views/Infos.vue"
import Registrierung from "@/views/Registrierung.vue"
import Projekte from "@/views/Projekte.vue"
import Dashboard from "@/views/Dashboard.vue"
import Login from "@/views/Login.vue"
import Datenschutzerklaerung from "@/views/Datenschutzerklaerung.vue"
import Auth from "@/services/Auth"

Vue.use(VueRouter)

const Router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      component: Home,
    },
    {
      path: "/projekte",
      component: Projekte,
    },
    {
      path: "/infos",
      component: Infos,
    },
    {
      path: "/datenschutzerklaerung",
      component: Datenschutzerklaerung,
    },
    {
      path: "/dashboard",
      component: Dashboard,
      beforeEnter: (to, from, next) => {
        console.log(Auth.guest())
        if (Auth.guest())
          return Router.push("/login")
        return next()
      },
    },
    {
      path: "/registrierung",
      component: Registrierung,
      beforeEnter: (to, from, next) => {
        if (Auth.check())
          return Router.push("/dashboard")
        return next()
      },
    },
    {
      path: "/login",
      component: Login,
      beforeEnter: (to, from, next) => {
        if (Auth.check())
          return Router.push("/dashboard")
        return next()
      },
    },
  ],
  scrollBehavior(to, from, savedPosition) {
    return {x: 0, y: 0}
  },
})

export default Router
