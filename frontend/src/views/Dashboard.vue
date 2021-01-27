<template>
  <main style="background-color: var(--gray-light)">
    <header class="d1">
      <div class="d2">
        <h1 style="font-weight:500;">Dashboard</h1>
        <button @click="logout" class="Link">Logout</button>
      </div>
    </header>

    <section class="d3">
      <div class="d4">

        <form @submit.prevent="userSave" novalidate>
          <h2 class="d5">Profil</h2>
          <div class="d9">
            <InputText label="Benutzername" :error="userErrors.username">
              <input v-model="user.username" type="text">
            </InputText>
            <InputText label="E-Mail" :error="userErrors.email">
              <input v-model="user.email" type="email">
            </InputText>
            <InputPassword label="Neues Passwort" :error="userErrors.password">
              <input v-model="user.password" type="password">
            </InputPassword>
            <button type="submit" class="Button" :disabled="userSaved">
              {{ userSaved ? "Gespeichert!" : "Speichern" }}
            </button>
          </div>
        </form>

        <form @submit.prevent="projectSave" novalidate>
          <h2 class="d5">Projekt</h2>
          <div class="d9">
            <InputText label="Name" :error="projectErrors.name">
              <input v-model="project.name" type="text">
            </InputText>
            <InputText label="Link" :error="projectErrors.link">
              <input
                v-model="project.link"
                type="text"
                placeholder="https://link-zu-deinem-projekt.ch"
              >
            </InputText>
            <InputText label="Beschreibung" :error="projectErrors.description">
              <textarea v-model="project.description"></textarea>
            </InputText>
            <InputImage
              label="Bild"
              v-model="project.image"
              :error="projectErrors.image"
            />
            <button type="submit" class="Button" :disabled="projectSaved">
              {{ projectSaved ? "Gespeichert!" : "Speichern" }}
            </button>
          </div>
        </form>

      </div>
    </section>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import * as u from "@/utils/utilFunctions"
  import Api from "@/services/Api"
  import Router from "@/services/Router"
  import InputText from "@/components/InputText.vue"
  import InputPassword from "@/components/InputPassword.vue"
  import InputImage from "@/components/InputImage.vue"
  import Auth from "@/services/Auth"

  @Component({
    name: "Dashboard",
    metaInfo: {
      title: "Dashboard",
    },
    components: {InputImage, InputPassword, InputText},
  })
  export default class Dashboard extends Vue {
    user: Partial<User> = {}
    userErrors: Partial<User> = {}
    userSaved = false

    project: Partial<Project> = {}
    projectErrors: Partial<Project> = {}
    projectSaved = false

    async userSave() {
      try {
        await Api.patch("user", this.user)
        this.userErrors = {}
        this.user.password = ""
        this.userSaved = true
        await u.sleep(1500)
        this.userSaved = false
      } catch (e) {
        this.userErrors = e.response.data.errors
      }
    }

    async projectSave() {
      try {
        await Api.patchBlob("project", this.project)
        this.projectErrors = {}
        this.projectSaved = true
        await u.sleep(1500)
        this.projectSaved = false
      } catch (e) {
        this.projectErrors = e.response.data.errors
      }
    }

    async logout() {
      await Auth.logout()
      location.replace('/login')
    }

    created() {
      Api.get("user").then(x => this.user = x)
      Api.get("project").then(x => this.project = x)
    }
  }
</script>

<style scoped>
  .d1 {
    padding: 0 1.5rem;
    background-color: white;
    box-shadow: var(--box-shadow);
  }
  .d2 {
    max-width: 1200px;
    margin: 0 auto;
    height: 4rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .d3 {
    padding: 3rem 1.5rem;
  }
  .d4 {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 3rem 1.5rem;
    @media (--md) {
      grid-template-columns: 1fr;
    }
  }
  .d5 {
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
  }
  .d9 {
    display: grid;
    grid-gap: 1.5rem;
    padding: 2rem;
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
  }
</style>
