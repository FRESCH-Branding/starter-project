<template>
  <footer class="p-7 text-20 bg-secondary text-primary">
    <div class="flex flex-col gap-8">
      <div class="flex justify-between">
        <NuxtLink to="/">
          <img />
          logo
        </NuxtLink>

        <ul class="flex gap-12">
          <li v-for="link in menu" class="">
            <NuxtLink :href="link.link"> {{ link.item }} </NuxtLink>
          </li>
        </ul>
      </div>

      <div class="flex justify-between text-12">
        <ul class="flex gap-4">
          <li>
            <NuxtLink to="/projecten">FB</NuxtLink>
          </li>
          <span>|</span>
          <li>{{ new Date().getFullYear() }} ©</li>
        </ul>

        <ul class="flex gap-4">
          <li>
            <NuxtLink to="/">Voorwaardes</NuxtLink>
          </li>
          <span>|</span>
          <li>
            <NuxtLink to="/over">Beleid</NuxtLink>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
const menu = [
  {
    item: "Home",
    link: "/",
  },
  {
    item: "Over",
    link: "/over",
  },
  {
    item: "Projecten",
    link: "/projecten",
  },
  {
    item: "Contact",
    link: "/contact",
  },
];
</script>

<style lang="scss" scoped></style>
