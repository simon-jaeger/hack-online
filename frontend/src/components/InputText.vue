<template>
  <div class="inputText" :class="{error}">
    <label :for="label">{{ label }}</label>
    <slot></slot>
    <small v-if="error" v-text="error" class="errorText"></small>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from "vue-property-decorator"

  @Component
  export default class InputText extends Vue {
    @Prop({required: true}) readonly label!: string
    @Prop() readonly error!: string

    mounted() {
      this.$el.querySelector("input")!.id = this.label
    }
  }
</script>

<style scoped>
  .inputText {
    position: relative;
    & > label {
      padding-bottom: 0.5rem;
    }
    & i {
      position: absolute;
      right: 1px;
      padding: 0.75rem;
      top: 3.5rem;
      transform: translateY(-50%);
      color: var(--black-lighter);
      background: linear-gradient(var(--gray-lighter), var(--gray-lighter)), linear-gradient(white, white);
      &:hover {
        color: var(--black);
      }
    }
    & > input {
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
    &.error > input {
      border-color: var(--red);
    }
  }
  .errorText {
    margin-top: 0.5rem;
    color: var(--red);
  }
</style>
