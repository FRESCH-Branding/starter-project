<template>
  <Swiper
    :modules="modules"
    :slides-per-view="3"
    :space-between="50"
    navigation
    :pagination="{ clickable: true }"
    :loop="true"
  >
    <SwiperSlide>test 1</SwiperSlide>
    <SwiperSlide>test 2</SwiperSlide>
    <SwiperSlide>test 4</SwiperSlide>
    <SwiperSlide>test 5</SwiperSlide>
    <SwiperSlide>test 6</SwiperSlide>
    <SwiperSlide>test 7</SwiperSlide>
    <SwiperSlide>test 8</SwiperSlide>
    <SwiperSlide>test 9</SwiperSlide>
  </Swiper>
</template>

<script setup>
import { Navigation, Pagination, Scrollbar } from "swiper/modules";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/swiper-bundle.css";

const modules = [Navigation, Pagination, Scrollbar];
</script>

<style lang="scss" scoped></style>
