<template>
  <div class="projectCard">
    <button
      class="image"
      :style="`background-image:url('${project.image}');`"
      type="button"
    >
      <i>fullscreen</i>
    </button>
    <div class="info">
      <div class="s1">
        <h2 style="font-weight:bold;" class="truncate">{{ project.name }}</h2>
        <button
          class="vote"
          type="button"
          @click="$emit('vote', project)"
          :disabled="Auth.guest() || project.owned"
        >
          <i class="star" :class="{voted: project.voted}">
            {{ project.voted ? "star" : "star_border" }}
          </i>
          <span style="font-size: 14px;">{{ project.votes.length }}</span>
        </button>
      </div>
      <small style="color:var(--black-light);" class="truncate">
        {{ project.user.username }}
      </small>
    </div>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from "vue-property-decorator"
  import Auth from "@/services/Auth"

  @Component
  export default class ProjectCard extends Vue {
    @Prop({required: true}) readonly project!: Project

    Auth = Auth
  }
</script>

<style scoped>
  .projectCard {
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    background-color: white;
  }
  .image {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    background-color: var(--black-light);
    background-size: cover;
    background-position: center;
    & > i {
      opacity: 0;
      position: absolute;
      top: 1rem;
      right: 1rem;
      width: 3rem;
      height: 3rem;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: var(--border-radius);
      color: var(--white-dark);
      background-color: var(--black-light);
      transition: opacity 0.3s;
      @media (--md) {
        display: none;
      }
      &:hover {
        color: var(--white);
      }
    }
    &:hover > i {
      opacity: 1;
    }
  }
  .info {
    padding: 1rem;
  }
  .vote {
    display: flex;
    align-items: center;
    white-space: nowrap;
    gap: 0.25rem;
    color: var(--black-lighter);
    font-size: 14px;
    &:hover {
      color: var(--black);
    }
  }
  .star {
    font-size: 1rem;
    &.voted {
      color: var(--gold);
    }
  }

  .s1 {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
  }
</style>
