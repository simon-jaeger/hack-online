<template>
  <InputText :label="label" :error="error">
    <button
      v-if="previewNewImage || value"
      @click="$fileInput.click()"
      type="button"
      class="image"
      :style="`background-image: url('${previewNewImage || value}')`"
    />

    <button
      v-else
      @click="$fileInput.click()"
      type="button"
      class="button"
    >
      <span>
        <i>cloud_upload</i>
        <span>Datei auswählen</span>
      </span>
    </button>

    <input
      @change="change"
      ref="$fileInput"
      type="file"
      accept="image/*"
      style="display:none;"
    >
  </InputText>
</template>

<script lang="ts">
  import {Component, Prop, Ref, Vue} from "vue-property-decorator"
  import InputText from "@/components/InputText.vue"

  // TODO: drag and drop
  // TODO: backend (same path: do nothing, emtpy string: null it, file: store file and update path

  @Component({
    components: {InputText},
  })
  export default class InputImage extends Vue {
    @Prop({required: true}) readonly label!: string
    @Prop() readonly error!: string
    @Prop({default: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="}) readonly value!: string | File // transparent image by default
    @Ref() readonly $fileInput!: HTMLInputElement

    previewNewImage = ""

    change() {
      URL.revokeObjectURL(this.previewNewImage)
      const file = this.$fileInput.files![0]
      if (file) {
        this.previewNewImage = URL.createObjectURL(file)
        this.$emit("input", file)
      } else {
        this.previewNewImage = ""
        this.$emit("input", "")
      }
    }
  }
</script>

<style scoped>
  .image {
    width: 100%;
    padding-bottom: 56.25%;
    border: 1px solid transparent;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  .button {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    border: 1px solid var(--gray);
    border-radius: var(--border-radius);
    color: var(--black-lighter);
    background-color: var(--gray-lighter);
    &:focus {
    }
    &:hover,
    &:focus-visible {
      border-color: var(--teal);
      color: var(--black-light);
    }
    & > span {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      & i {
        font-size: 8rem;
        line-height: 1;
        margin-bottom: 0.5rem;
        @media (--md) {
          font-size: 4rem;
        }
      }
    }
  }
</style>
