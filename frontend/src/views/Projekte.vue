<template>
  <main class="p1">
    <div class="p2">
      <ProjectCard
        v-for="project of projects"
        :project="project"
        @open="openProject = project"
        @vote="vote(project)"
      />
    </div>
    <ProjectDetails :project="openProject" @close="openProject = null" @vote="vote(openProject)"/>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Api from "@/services/Api"
  import ProjectCard from "@/components/ProjectCard.vue"
  import ProjectDetails from "@/components/ProjectDetails.vue"

  @Component({
    metaInfo: {
      title: "Projekte",
    },
    components: {ProjectDetails, ProjectCard},
  })
  export default class Projekte extends Vue {
    user: User | null = null
    projects: Project[] = []
    openProject: Project|null = null
    pollingInterval

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

    getProjects() {
      console.log('get')
      Api.get("projects").then(x => this.projects = x)
    }

    activated() {
      this.getProjects()
      this.pollingInterval = setInterval(this.getProjects, 4000)
    }

    deactivated() {
      clearInterval(this.pollingInterval)
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
    grid-gap: 1.5rem;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    @media (--md) {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    @media (--sm) {
      grid-template-columns: repeat(1, minmax(0, 1fr));
    }
  }
</style>
