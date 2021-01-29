<template>
  <InputText :label="label" :error="error">
    <button
      v-if="previewNewImage || value"
      @click="$fileInput.click()"
      @drop.prevent="onDrop"
      @dragover.prevent
      type="button"
      class="image"
      :style="`background-image: url('${previewNewImage || value}')`"
    />

    <button
      v-else
      @click="$fileInput.click()"
      @drop.prevent="onDrop($event); drop = false;"
      @dragover.prevent
      @dragenter.prevent="drop = true"
      @dragleave.prevent="drop = false"
      type="button"
      class="button"
      :class="{drop}"
    >
      <span>
        <i>cloud_upload</i>
        <span>Datei auswählen</span>
      </span>
    </button>

    <input
      @change="onChange"
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

  @Component({
    components: {InputText},
  })
  export default class InputImage extends Vue {
    @Prop({required: true}) readonly label!: string
    @Prop() readonly error!: string
    @Prop({default: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII="}) readonly value!: string | File // transparent image by default
    @Ref() readonly $fileInput!: HTMLInputElement

    previewNewImage = ""
    drop = false

    onChange() {
      URL.revokeObjectURL(this.previewNewImage)
      const file = this.$fileInput.files?.[0]
      if (file) {
        this.previewNewImage = URL.createObjectURL(file)
        this.$emit("input", file)
      } else {
        this.previewNewImage = ""
        this.$emit("input", "")
      }
    }

    onDrop(e: DragEvent) {
      this.$fileInput.files = e.dataTransfer!.files
      this.onChange()
    }
  }
</script>

<style scoped>
  .image {
    width: 100%;
    padding-bottom: 56.25%;
    border-top: 1px solid transparent;
    border-bottom: 1px solid transparent;
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
    &:hover,
    &.drop,
    &:focus-visible {
      border-color: var(--teal);
      color: var(--black-light);
    }
    & > span {
      pointer-events: none;
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
        @media (--md) {
          font-size: 4rem;
        }
      }
    }
  }
</style>
