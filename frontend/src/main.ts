import "@/css/reset.css"
import "@/css/base.pcss"
import "@/css/wysiwyg.pcss"
import "@/components/Button.pcss"
import "@/components/Link.pcss"

import Vue from "vue"
import VueMeta from "vue-meta"
import "vue-class-component/hooks"
import "reflect-metadata"
import "@/utils/directives"
import "@/utils/cssVars"
import App from "./App.vue"
import Router from "@/services/Router"
import Api from "@/services/Api"

Vue.use(VueMeta)
Vue.config.productionTip = false
new Vue({
  router: Router,
  render: h => h(App),
}).$mount("#app")

// set remembered user
Api.get("user").then(user => {
  localStorage.setItem("user", user)
})

// TODO: rm, dev helper
// @ts-ignore
window.Api = Api
