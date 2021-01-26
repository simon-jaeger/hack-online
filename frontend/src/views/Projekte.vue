<template>
  <main class="p1">
    <div class="p2">
      <ProjectCard v-for="p of projects" :project="p"/>
    </div>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Api from "@/services/Api"
  import ProjectCard from "@/components/ProjectCard.vue"

  @Component({
    metaInfo: {
      title: "Projekte",
    },
    components: {ProjectCard},
  })
  export default class Projekte extends Vue {
    projects: Project[] = []

    async activated() {
      this.projects = await Api.get("projects")
    }
  }
</script>

<style scoped>
  .p1 {
    background-color: var(--gray-light);
    padding: 4rem 2rem;
    @media (--sm) {
      padding-top: 2rem;
    }
  }
  .p2 {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-gap: 1.5em;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    @media (--md) {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    @media (--sm) {
      grid-template-columns: repeat(1, minmax(0, 1fr));
    }
  }
</style>
