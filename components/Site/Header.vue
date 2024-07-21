<template>
  <header class="flex justify-between p-7 text-20 bg-secondary text-primary">
    <NuxtLink to="/">
      <img />
      logo
    </NuxtLink>

    <ul class="flex gap-12">
      <li>
        <NuxtLink to="/">Home</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/over">Over</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/projecten">Projecten</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/contact">Contact</NuxtLink>
      </li>
    </ul>

    <button @click="toggleDarkMode" class="color-toggle">
      <FontAwesomeIcon
        :icon="isClicked ? ['fas', 'lightbulb'] : ['far', 'lightbulb']"
        :id="isClicked ? 'dark' : 'light'"
      />
    </button>
  </header>
</template>

<script setup lang="ts">
import { ref, watch, onMounted } from "vue";

const isClicked = ref(false);

const toggleDarkMode = () => {
  isClicked.value = !isClicked.value;
};

onMounted(() => {
  if (
    window.matchMedia &&
    window.matchMedia("(prefers-color-scheme: dark)").matches
  ) {
    isClicked.value = true;
  }
});

watch(isClicked, (newValue) => {
  if (newValue) {
    document.documentElement.classList.add("dark");
    document.documentElement.classList.remove("light");
  } else {
    document.documentElement.classList.remove("dark");
    document.documentElement.classList.add("light");
  }
});
</script>
