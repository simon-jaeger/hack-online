<template>
  <main>
    <div class="i1">
      <div v-if="d" class="i2 wysiwyg">
        <h1>{{ d.title }}</h1>
        <div class="i3" :style="`background-image: url('${d.img.path}');`">
        </div>
        <div v-html="marked(d.value)"></div>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Cms from "@/services/Cms"
  import marked from "marked"
  import {InfosInterface} from "@/views/InfosInterface"

  @Component({
    metaInfo: {
      title: "Infos",
    },
    components: {},
  })
  export default class Infos extends Vue {
    d: null | InfosInterface = null
    marked = marked

    async created() {
      this.d = await Cms.get("infos")
    }
  }
</script>

<style scoped>
  .i1 {
    padding: 4rem 2rem;
    @media (--sm) {
      padding-top: 2rem;
    }
  }
  .i2 {
    max-width: 680px;
    margin: 0 auto;
  }
  .i3 {
    padding-bottom: 50%;
    background-repeat: no-repeat;
    background-position: center;
    margin: 3rem auto;
  }
</style>

<style>
</style>
