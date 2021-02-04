<template>
  <div class="inputText" :class="{error}">
    <label :for="label">{{ label }}</label>
    <slot></slot>
    <small v-if="error" class="errorText">{{ error }}</small>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from "vue-property-decorator"

  @Component
  export default class InputText extends Vue {
    @Prop({required: true}) readonly label!: string
    @Prop() readonly error!: string

    mounted() {
      this.$el.querySelector("input, textarea")!.id = this.label
    }
  }
</script>

<style scoped>
  .inputText {
    position: relative;
    & > label {
      padding-bottom: 0.5rem;
    }
    & > input,
    & > textarea {
      width: 100%;
      height: 3rem;
      padding: 0 1rem;
      border: 1px solid var(--gray);
      border-radius: var(--border-radius);
      background-color: var(--gray-lighter);
      &:focus {
        border-color: var(--teal);
      }
    }
    & > textarea {
      height: 12rem;
      padding: 0.75rem 1rem;
    }
    &.error > input,
    &.error > textarea {
      border-color: var(--red);
    }
  }
  .errorText {
    margin-top: 0.5rem;
    color: var(--red);
  }
</style>
