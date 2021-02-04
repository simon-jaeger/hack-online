<template>
  <div class="projectDetails" v-if="project" @click.self="$emit('close')">
    <div class="inner">
      <button
        @click="$emit('close')"
        type="button"
        class="back"
      ><i>close</i>
      </button>
      <div
        class="image"
        :style="`background-image:url('${project.image}');`"
      ></div>
      <div class="info">
        <h2
          style="font-size: 1.5rem; line-height: 1; font-weight:bold; margin-bottom: 0.25rem;"
          class="truncate"
        >{{ project.name }}</h2>
        <small
          style="color:var(--black-lighter); margin-bottom: 1.5rem;"
          class="truncate"
        >
          {{ project.user.username }}
        </small>
        <div class="actions">
          <a v-if="project.link" :href="project.link" target="_blank">
            <i>link</i>
            <span
              style="max-width: 12rem"
              class="truncate"
            >{{ project.link.replace(/^https?:\/\//, "") }}</span>
          </a>
          <button
            @click="$emit('vote')"
            :disabled="Auth.guest() || project.owned"
            class="vote"
            type="button"
          >
            <i :class="{voted: project.voted}">{{ project.voted ? "star" : "star_border" }}</i>
            {{ project.votes.length }} {{ project.votes.length === 1 ? "Stimme" : "Stimmen" }}
          </button>
        </div>
        <p style="margin-bottom: 2rem; line-height: 1.7;">{{ project.description }}</p>
        <small style="font-size: 14px; color:var(--black-lighter); padding-top: 1rem; border-top: 1px solid var(--gray);">
          Zuletzt aktualisert am {{ date }}
        </small>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue, Watch} from "vue-property-decorator"
  import {format} from "date-fns"
  import {de} from "date-fns/locale"
  import Auth from "@/services/Auth"

  @Component
  export default class ProjectDetails extends Vue {
    @Prop({required: true}) readonly project!: Project

    Auth = Auth

    get date() {
      const date = new Date(this.project.updated_at)
      return format(date, "d. MMMM yyyy", {locale: de})
    }

    @Watch("project")
    syncBodyScroll() {
      const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth
      document.body.style.overflow = this.project ? "hidden" : ""
      document.body.style.paddingRight = this.project ? scrollbarWidth + "px" : ""
    }
  }
</script>

<style scoped>
  .projectDetails {
    z-index: 100;
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: flex;
    max-height: 100vh;
    overflow-y: auto;
    background-color: var(--black-alpha);
  }
  .inner {
    width: 800px;
    max-width: 100vw;
    display: flex;
    flex-direction: column;
    margin: auto;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--box-shadow);
    @media (--sm) {
      border-radius: 0;
      min-height: 100vh;
    }
  }
  .back {
    width: 100%;
    padding: 0.75rem;
    text-align: right;
    color: var(--white-dark);
    background-color: var(--black);
    &:hover {
      color: var(--white);
    }
  }
  .image {
    padding-bottom: 56.25%;
    background-color: var(--gray);
    background-size: cover;
    background-position: center;
  }
  .info {
    flex-grow: 1;
    flex-shrink: 1;
    padding: 1.5rem;
    background-color: white;
  }
  .actions {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    @media (--sm) {
      flex-direction: column;
    }
    & > * {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 1rem;
      border: 1px solid var(--black-lighter);
      border-radius: var(--border-radius);
      color: var(--black-light);
      &:hover {
        background-color: var(--gray-alpha);
        border-color: var(--black);
      }
      &.vote:hover {
        background-color: var(--gold-alpha);
        border-color: var(--gold);
      }
      & > i.voted {
        color: var(--gold);
      }
    }
  }
</style>
