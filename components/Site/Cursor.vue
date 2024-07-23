<template>
  <svg id="line-1" class="stroke-black"></svg>
  <svg id="line-2" class="stroke-cyan-500"></svg>
</template>

<script setup>
import { onMounted, onBeforeUnmount } from "vue";
import gsap from "gsap";

const svgns = "http://www.w3.org/2000/svg";
const ease = 0.7;

const pointer = {
  x: 0,
  y: 0,
};

function updatePointer(event) {
  pointer.x = event.clientX;
  pointer.y = event.clientY;
}

function createLine(leader) {
  const line = document.createElementNS(svgns, "line");

  const get = gsap.getProperty(line);
  const set = gsap.quickSetter(line, "attr");

  const modifier = (prop) => {
    const n2 = `${prop}2`;

    return () => {
      const posN = get(prop);
      const leaderN = leader(prop);
      const n = posN + (leaderN - posN) * ease;

      set({ [n2]: leaderN - n });

      return n;
    };
  };

  gsap.set(line, pointer);

  gsap.to(line, {
    x: "+=1",
    y: "+=1",
    repeat: -1,
    ease: "linear",
    modifiers: {
      x: modifier("x"),
      y: modifier("y"),
    },
  });

  return line;
}

function createTrail(selector, trailLength = 10) {
  const root = document.querySelector(selector);

  let leader = (prop) => (prop === "x" ? pointer.x : pointer.y);

  for (let i = 0; i < trailLength; i++) {
    const line = createLine(leader);
    root.appendChild(line);
    leader = gsap.getProperty(line);
  }
}

onMounted(() => {
  pointer.x = window.innerWidth / 2;
  pointer.y = window.innerHeight / 2;

  window.addEventListener("pointerdown", updatePointer);
  window.addEventListener("pointermove", updatePointer);

  createTrail("#line-1", 4);
  createTrail("#line-2", 2);
});

onBeforeUnmount(() => {
  window.removeEventListener("pointerdown", updatePointer);
  window.removeEventListener("pointermove", updatePointer);
});
</script>

<style lang="scss" scoped>
svg {
  @apply fixed top-0 left-0 h-full w-full pointer-events-none;
}
#line-1,
#line-2 {
  stroke-width: 10;
  stroke-linecap: round;
}
</style>
