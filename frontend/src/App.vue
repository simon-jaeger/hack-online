<template>
  <div>
    <a id="top" href="#"></a>
    <Header/>
    <KeepAlive max="8" :exclude="['Registrierung', 'Login']">
      <RouterView/>
    </KeepAlive>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Header from "@/components/Header.vue"

  @Component({
    components: {Header},
    metaInfo: {
      titleTemplate: "HACK::ONLINE | %s",
      meta: [
        {
          name: "description",
          content: "Ein kleiner Online-Hackathon, nur zum Spass. Das ist die Idee hinter HACK::ONLINE. Nutze die Chance um eine neue Technologie auszuprobieren, eine Idee die du schon lange hast endlich umzusetzen oder einfach nur drauf los zu hacken.",
        },
      ],
    },
  })
  export default class App extends Vue {
  }
</script>
