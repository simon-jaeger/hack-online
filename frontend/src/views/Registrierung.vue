<template>
  <main style="background-color: var(--gray-light)">
    <div class="s1">
      <div class="s3">
        <h1>Registrierung</h1>
        <h2>HACK::ONLINE</h2>
      </div>
      <form class="s2" @submit.prevent="register" novalidate>
        <InputText label="Benutzername" :error="errors.username">
          <input v-model="user.username" type="text">
        </InputText>
        <InputText label="E-Mail" :error="errors.email">
          <input v-model="user.email" type="email">
        </InputText>
        <InputPassword label="Passwort" :error="errors.password">
          <input v-model="user.password">
        </InputPassword>
        <p style="font-size:14px; color:var(--black-light);">
          Durch die Registrierung akzeptierst du die
          <RouterLink class="Link" to="/datenschutzerklaerung">
            Datenschutzerklärung
          </RouterLink>
        </p>
        <button type="submit" class="Button">Registrieren</button>
      </form>
      <p class="s4">
        Schon registriert? <br>
        <RouterLink to="/login" class="Link">Zum Login</RouterLink>
      </p>
    </div>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import InputText from "@/components/InputText.vue"
  import Router from "@/services/Router"
  import InputPassword from "@/components/InputPassword.vue"
  import Auth from "@/services/Auth"

  @Component({
    name: "Registrierung",
    metaInfo: {
      title: "Registrierung",
    },
    components: {InputPassword, InputText},
  })
  export default class Registrierung extends Vue {
    user: Partial<User> = {}
    errors: Partial<User> = {}

    async register() {
      try {
        await Auth.register(this.user)
        await Router.push("/dashboard")
      } catch (e) {
        this.errors = e.response.data.errors
      }
    }
  }
</script>

<style scoped>
  .s1 {
    padding: 3rem 1.5rem;
  }
  .s2 {
    display: grid;
    grid-gap: 1.5rem;
    max-width: 480px;
    padding: 2rem;
    margin: 0 auto;
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
  }
  .s3 {
    max-width: 480px;
    margin: 0 auto 3rem;
    text-align: center;
    & h1 {
      color: var(--black-light);
    }
    & h2 {
      font-size: 1.5rem;
      font-weight: bold;
    }
  }
  .s4 {
    max-width: 480px;
    margin: 1rem auto 0;
    color: var(--black-light);
  }
</style>
