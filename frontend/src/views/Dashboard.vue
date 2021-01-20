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

        <form>
          <h2 class="d5">Projekt</h2>
          <div class="d9" style="color:var(--black-lighter);">
            Folgt demnächst...
          </div>
        </form>

      </div>
    </section>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Api from "@/services/Api"
  import Router from "@/services/Router"
  import InputText from "@/components/InputText.vue"
  import * as u from "@/utils/utilFunctions"
  import InputPassword from "@/components/InputPassword.vue"

  @Component({
    name: "Dashboard",
    metaInfo: {
      title: "Dashboard",
    },
    components: {InputPassword, InputText},
  })
  export default class Dashboard extends Vue {
    user: Partial<User> = {
      username: "",
      email: "",
      password: "",
    }

    userErrors: Partial<User> = {
      username: "",
      email: "",
      password: "",
    }

    userSaved = false

    async userSave() {
      try {
        await Api.patch("user", this.user)
        Object.assign(this.userErrors, u.mapValues(this.userErrors, x => ""))
        this.user.password = ""
        this.userSaved = true
        await u.sleep(1500)
        this.userSaved = false
      } catch (e) {
        console.warn(e.response)
        Object.assign(this.userErrors, u.mapValues(this.userErrors, x => ""))
        Object.assign(this.userErrors, u.mapValues(e.response.data.errors, x => x[0]))
      }
    }

    async logout() {
      await Api.post("logout")
      localStorage.setItem("user", "")
      await Router.push("/login")
    }

    async created() {
      Object.assign(this.user, await Api.get("user"))
      if (!this.user) await Router.push("/login")
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
