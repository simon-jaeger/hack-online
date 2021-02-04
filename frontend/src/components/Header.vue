<template>
  <nav class="header">
    <div class="inner">
      <a @click="window.scrollTo({top: 0, behavior: 'smooth'}); $router.push('/')" class="logo">HACK::ONLINE</a>
      <RouterLink to="/projekte" class="link">Projekte</RouterLink>
      <RouterLink to="/infos" class="link">Infos</RouterLink>
      <RouterLink to="/dashboard" style="display: contents;">
        <i class="icon">account_circle</i>
      </RouterLink>
    </div>
  </nav>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from "vue-property-decorator"

  @Component
  export default class Header extends Vue {
    window = window
  }
</script>

<style scoped>
  .header {
    position: sticky;
    top: 0;
    z-index: 100;
    background-color: black;
    padding: 0 1.5rem;
    user-select: none;
  }
  .inner {
    height: 4rem;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
  }
  .logo {
    margin-right: 3rem;
    font-weight: bold;
    color: var(--white);
    cursor: pointer;
    @media (--sm) {
      margin-right: 1.5rem;
    }
  }
  .link {
    padding: 1rem;
    color: var(--white-dark);
    &:hover, &:focus-visible {
      color: var(--white);
    }
    @media (--sm) {
      padding: 1rem 0.5rem;
    }
  }
  .icon {
    margin-left: auto;
    font-size: 2rem;
    color: var(--white-dark);
    &:hover, &:focus-visible {
      color: var(--white);
    }
  }

  .router-link-active {
    color: var(--white);
  }
  .router-link-active > i {
    color: var(--white);
  }
</style>
