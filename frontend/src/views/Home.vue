<template>
  <main>
    <section class="a1">
      <div v-if="d" class="a2">
        <h1 class="a3">
          {{ d.heroTitle.split("::")[0] }}::<br class="m2">{{
          d.heroTitle.split("::")[1] }}
        </h1>
        <p class="a4">{{ d.heroSub }}</p>
        <RouterLink :to="d.heroUrl" class="Button m1">{{ d.heroButton }}
        </RouterLink>
      </div>
      <button
        @click="$refs.more.scrollIntoView({block:'start', behavior:'smooth'})"
        style="display: contents;"
      >
        <i class="a5">keyboard_arrow_down</i>
      </button>
    </section>

    <a
      ref="more"
      href="#"
      style="position:relative; top: -4rem; pointer-events: none"
    ></a>

    <div v-if="d">
      <section v-for="s of d.sections" class="b1">
        <div class="b2">
          <div>
            <h2 class="b3">{{ s.value.title }}</h2>
            <p class="b4">{{ s.value.body }}</p>
            <RouterLink :to="s.value.ctaUrl" class="b5">{{ s.value.ctaText }}
            </RouterLink>
          </div>
          <img :src="s.value.image.path" :alt="s.value.image.meta.title">
        </div>
      </section>
    </div>

    <section v-if="d" class="c1">
      <div class="c2">
        <div>
          <h2 class="c3">{{ d.discord.title }}</h2>
          <p class="c4">{{ d.discord.body }}</p>
          <a :href="d.discord.ctaUrl" target="_blank" rel="noopener" class="c5">
            {{ d.discord.ctaText }}
          </a>
        </div>
        <iframe
          class="c6"
          title="Discord widget"
          src="https://discord.com/widget?id=798210141027041300&theme=dark"
          sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"
        ></iframe>
      </div>
    </section>

  </main>
</template>

<script lang="ts">
  import {Component, Vue} from "vue-property-decorator"
  import Cms from "@/services/Cms"
  import {HomeInterface} from "@/views/HomeInterface"

  @Component({
    metaInfo: {
      title: "Home",
    },
    components: {},
  })
  export default class Home extends Vue {
    d: HomeInterface | null = null

    async created() {
      this.d = await Cms.get("home")
    }
  }
</script>

<style scoped>
  .m1 {
    display: inline-block;
    padding: 1.5rem 2rem;
    font-size: 1.5rem;
    @media (--sm) {
      display: block;
    }
  }
  .m2 {
    display: none;
    @media (--sm) {
      display: block;
    }
  }

  .a1 {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: calc(100vh - 4rem);
    padding: 3rem;
    background: var(--black);
    overflow: hidden;
    user-select: none;
    @media (--md) {
      height: calc(var(--vhi) * 100 - 4rem);
    }
    @media (--sm) {
      padding: 2rem;
    }
  }
  .a2 {
    width: 1200px;
  }
  .a3 {
    margin-bottom: 2rem;
    font-size: 8rem;
    font-weight: 900;
    line-height: 1;
    color: var(--white);
    text-shadow: var(--text-shadow);
    white-space: nowrap;
    @media (--md) {
      font-size: 5rem;
    }
    @media (--sm) {
      font-size: 4rem;
      margin-bottom: 1rem;
    }
  }
  .a4 {
    margin-bottom: 3rem;
    font-size: 4rem;
    font-weight: bold;
    line-height: 1;
    color: var(--white-dark);
    @media (--md) {
      font-size: 3rem;
    }
    @media (--sm) {
      font-size: 2rem;
    }
  }
  .a5 {
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 1rem;
    font-size: 6rem;
    text-align: center;
    color: var(--white);
    animation: a5 1.5s infinite alternate-reverse;
    @media (--sm) {
      font-size: 4rem;
    }
  }
  @keyframes a5 {
    0% {
      transform: translateY(-0.5rem)
    }
    100% {
      transform: translateY(0.5rem)
    }
  }

  .b1 {
    padding: 6rem 4rem;
    background-color: white;
    &:not(:first-child) {
      margin-top: -6rem;
    }
    &:nth-child(even) > .b2 > img {
      grid-row: 1;
      grid-column: 1;
    }
    @media (--md) {
      &:nth-child(even) > .b2 > img {
        grid-row: 2;
      }
    }
    @media (--sm) {
      padding: 3rem 2rem;
      &:not(:first-child) {
        margin-top: -1.5rem;
      }
    }
  }
  .b2 {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 3rem 6rem;
    align-items: center;
    @media (--md) {
      max-width: 600px;
      grid-template-columns: 1fr;
    }
  }
  .b3 {
    font-size: 3rem;
    font-weight: 700;
    line-height: 1.25;
    margin-bottom: 0.5rem;
  }
  .b4 {
    margin-bottom: 1rem;
    font-size: 1.25rem;
    color: var(--black-light);
  }
  .b5 {
    font-size: 1.25rem;
    font-weight: 500;
    color: var(--teal);
    &:hover, &:focus-visible {
      text-decoration: underline;
    }
  }

  .c1 {
    padding: 6rem 4rem;
    background: var(--black);
    @media (--sm) {
      padding: 3rem 2rem;
    }
  }
  .c2 {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 3rem 6rem;
    align-items: center;
    @media (--md) {
      max-width: 600px;
      grid-template-columns: 1fr;
    }
  }
  .c3 {
    margin-bottom: 0.5rem;
    font-size: 3rem;
    font-weight: 700;
    line-height: 1.25;
    color: var(--white);
  }
  .c4 {
    margin-bottom: 1rem;
    font-size: 1.25rem;
    color: var(--white-dark);
  }
  .c5 {
    font-size: 1.25rem;
    font-weight: 500;
    color: var(--teal-light);
    &:hover, &:focus-visible {
      text-decoration: underline;
    }
  }
  .c6 {
    width: 100%;
    height: 24rem;
  }
</style>
