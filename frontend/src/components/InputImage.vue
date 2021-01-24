<template>
  <InputText :label="label" :error="error">
    <button
      v-if="previewNewImage || value"
      @click="$fileInput.click()"
      type="button"
      style="width: 100%;"
    >
      <img
        class="image"
        :src="previewNewImage || value"
        alt=""
      />
    </button>

    <button
      v-else
      @click="$fileInput.click()"
      type="button"
      class="button"
    >
      <i>cloud_upload</i>
      <span>Datei auswählen oder hier hin ziehen</span>
    </button>

    <input
      @change="change"
      ref="$fileInput"
      type="file"
      accept="image/*"
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
    height: 16rem;
    object-fit: cover;
  }
  .button {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 16rem;
    border: 1px solid var(--gray);
    border-radius: var(--border-radius);
    color: var(--black-lighter);
    background-color: var(--gray-lighter);
    &:focus{}
    &:hover,
    &:focus-visible {
      border-color: var(--teal);
      color: var(--black-light);
    }
    & i {
      font-size: 8rem;
    }
  }
</style>
