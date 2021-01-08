import Vue from "vue"
import {Route, RawLocation} from "vue-router"

declare module "vue/types/vue" {
  interface Vue {
    beforeRouteEnter?(to, from, next)

    beforeRouteLeave?(to, from, next)

    beforeRouteUpdate?(to, from, next)
  }
}
