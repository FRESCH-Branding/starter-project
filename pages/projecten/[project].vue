<template>
  <div class="grid grid-rows-3 grid-cols-3 gap-[30px] p-10">
    <div class="grid-item h-[fit] bg-primary">
      <img :src="project1" />
    </div>
    <div class="grid-item row-span-2 col-span-2 bg-primary">
      <img :src="project2" />
    </div>
    <div class="grid-item row-span-2 bg-primary">
      <img :src="project3" />
    </div>
    <div class="grid-item bg-primary">
      <img :src="project4" />
    </div>
    <div class="grid-item bg-primary">
      <img :src="project5" />
    </div>
    <div class="grid-item h-[fit] col-span-2 bg-primary">
      <img :src="project6" />
    </div>
    <div class="grid-item row-span-2 bg-primary">
      <img :src="project7" />
    </div>
    <div class="grid-item h-[fit] bg-primary">
      <img :src="project8" />
    </div>
    <div class="grid-item bg-primary">
      <img :src="project9" />
    </div>
    <div class="grid-item row-span-2 col-span-2 bg-primary">
      <img :src="project10" />
    </div>
    <div class="grid-item h-[fit] bg-primary">
      <img :src="project11" />
    </div>
    <div class="grid-item h-[fit] bg-primary">
      <img :src="project12" />
    </div>
  </div>
</template>

<script setup>
// const ImageSrc = "https://picsum.photos/550/400";

const projects = {
  project1: "https://picsum.photos/550/400",
  project2: "https://picsum.photos/550/400",
  project3: "https://picsum.photos/550/400",
  project4: "https://picsum.photos/550/400",
  project5: "https://picsum.photos/550/400",
  project6: "https://picsum.photos/550/400",
  project7: "https://picsum.photos/550/400",
  project8: "https://picsum.photos/550/400",
  project9: "https://picsum.photos/550/400",
  project10: "https://picsum.photos/550/400",
  project11: "https://picsum.photos/550/400",
  project12: "https://picsum.photos/550/400",
};
</script>

<style scoped>
.grid-item {
  @apply rounded-[25px];
}
</style>
