<template>
  <main>
    <div class="p1">
      <ComingSoon/>
    </div>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import ComingSoon from "@/components/ComingSoon.vue"

  @Component({
    metaInfo: {
      title: "Projekte",
    },
    components: {ComingSoon},
  })
  export default class Projekte extends Vue {
    async activated() {
      // load data here, runs on initial creation and every following activation
    }
  }
</script>

<style scoped>
  .p1 {
    padding: 3rem 1.5rem;
  }
</style>
