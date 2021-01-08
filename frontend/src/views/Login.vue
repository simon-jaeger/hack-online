<template>
  <main style="background-color: var(--gray-light)">
    <div class="r1">
      <div class="r3">
        <h1>Login</h1>
        <h2>HACK::ONLINE</h2>
      </div>
      <form class="r2" @submit.prevent="login" novalidate>
        <InputText label="E-Mail oder Benutzername" :error="errors.email">
          <input v-model="user.email" type="text">
        </InputText>
        <InputText label="Passwort" :error="errors.password">
          <input
            v-model="user.password"
            :type="passwordVisible ? 'text' : 'password'"
          >
          <button
            type="button"
            @click="passwordVisible = !passwordVisible"
            style="display: contents;"
          >
            <i>{{ passwordVisible ? "visibility_off" : "visibility" }}</i>
          </button>
        </InputText>
        <button type="submit" class="Button">Login</button>
      </form>

      <p class="r4">
        Noch nicht registriert? <br>
        <RouterLink to="/registrierung" class="Link">Zur Registrierung
        </RouterLink>
      </p>
    </div>
  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import InputText from "@/components/InputText.vue"
  import Api from "@/services/Api"
  import * as u from "@/utils/utilFunctions"
  import Router from "@/services/Router"

  @Component({
    name: 'Login',
    metaInfo: {
      title: "Login",
    },
    components: {InputText},
  })
  export default class Login extends Vue {
    user: Partial<User> = {
      email: "",
      password: "",
    }

    errors: Partial<User> = {
      email: "",
      password: "",
    }

    passwordVisible = false

    async login() {
      try {
        localStorage.setItem("user", await Api.post("login", this.user))
        await Router.push("/dashboard")
      } catch (e) {
        console.warn(e.response)
        Object.assign(this.errors, u.mapValues(this.errors, x => ""))
        Object.assign(this.errors, u.mapValues(e.response.data.errors, x => x[0]))
      }
    }
  }
</script>

<style scoped>
  .r1 {
    padding: 3rem 1.5rem;
  }
  .r2 {
    display: grid;
    grid-gap: 1.5rem;
    max-width: 480px;
    padding: 2rem;
    margin: 0 auto;
    background-color: white;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
  }
  .r3 {
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
  .r4 {
    max-width: 480px;
    margin: 1rem auto 0;
    color: var(--black-light);
  }
</style>
