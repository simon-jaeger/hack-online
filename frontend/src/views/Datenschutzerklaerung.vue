<template>
  <main>
    <div class="d8">
      <div class="d2 wysiwyg" v-html="d"></div>
    </div>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Cms from "@/services/Cms"

  @Component({
    metaInfo: {
      title: "Datenschutzerklaerung",
    },
    components: {},
  })
  export default class Datenschutzerklaerung extends Vue {
    d: null | string = null

    async created() {
      this.d = (await Cms.get("datenschutzerklaerung")).value
    }
  }
</script>

<style scoped>
  .d8 {
    padding: 4rem 2rem;
    @media (--sm) {
      padding-top: 2rem;
    }
  }
  .d2 {
    max-width: 680px;
    margin: 0 auto;
  }
</style>
