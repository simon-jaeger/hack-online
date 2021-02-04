<template>
  <InputText :label="label" :error="error">
    <slot></slot>
    <button
      type="button"
      @click="passwordVisible = !passwordVisible"
      style="display: contents;"
    >
      <i class="toggle">
        {{ passwordVisible ? "visibility_off" : "visibility" }}
      </i>
    </button>
  </InputText>
</template>

<script lang="ts">
  import {Component, Prop, Vue, Watch} from "vue-property-decorator"
  import InputText from "@/components/InputText.vue"

  @Component({
    components: {InputText},
  })
  export default class InputPassword extends Vue {
    @Prop({required: true}) readonly label!: string
    @Prop() readonly error!: string

    passwordVisible = false

    @Watch("passwordVisible")
    syncInputType() {
      this.$el.querySelector("input")!.type = this.passwordVisible ? "text" : "password"
    }

    mounted() {
      this.syncInputType()
    }
  }
</script>

<style scoped>
  .toggle {
    position: absolute;
    right: 1px;
    padding: 0.75rem;
    top: 3.5rem;
    transform: translateY(-50%);
    color: var(--black-lighter);
    background-color: var(--gray-lighter);
    &:hover {
      color: var(--black);
    }
  }
</style>
