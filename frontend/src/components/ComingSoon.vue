<template>
  <div class="comingSoon">
    Folgt demnächst...
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from "vue-property-decorator"

  @Component
  export default class Counter extends Vue {
  }
</script>

<style scoped>
  .comingSoon {
    max-width: 800px;
    height: 12rem;
    padding: 2rem;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--gray-lighter);
    border: 1px solid var(--gray);
    border-radius: var(--border-radius);
    color: var(--black-lighter);
  }
</style>
