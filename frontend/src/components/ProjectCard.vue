<template>
  <div class="projectCard" style="">
    <div
      class="image"
      :style="`background-image:url('${project.image}');`"
    ></div>
    <div class="info">
      <h2 style="font-weight:bold;">{{ project.name }}</h2>
      <small style="color:var(--black-light);">
        {{ project.user.username }}
      </small>
    </div>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from "vue-property-decorator"

  // TODO: long text dots
  // TODO: star
  // TODO: hover icon

  @Component
  export default class ProjectCard extends Vue {
    @Prop({required: true}) readonly project!: Project
  }
</script>

<style scoped>
  .projectCard {
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    background-color: white;
  }
  .image {
    padding-bottom: 56.25%;
    background-color: var(--black-light);
    background-size: cover;
    background-position: center;
  }
  .info {
    padding: 1rem;
  }
</style>
