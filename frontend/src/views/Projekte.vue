<template>
  <main class="p1">
    <div class="p2">
      <ProjectCard
        v-for="p of projects"
        :project="p"
        :disableVoting="!user || p.owned"
        @vote="vote"
      />
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
    user: User | null = null
    projects: Project[] = []

    async vote(project: Project) {
      // optimistic update
      if (project.voted) {
        project.voted = false
        project.votes.pop()
      } else {
        project.voted = true // @ts-ignore
        project.votes.push(null)
      }

      await Api.post("projects" + `/${project.id}/` + "vote")
      this.projects = await Api.get("projects")
    }

    activated() {
      Api.get("user").then(x => this.user = x)
      Api.get("projects").then(x => this.projects = x)
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
