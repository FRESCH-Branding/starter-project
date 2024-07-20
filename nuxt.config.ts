// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: true,
  devtools: { 
    enabled: false 
  },
  css: [
    '~/assets/css/tailwind.css',
    '@fortawesome/fontawesome-svg-core/styles.css'
  ],
  
  runtimeConfig: {
    public: {
      googleTagManagerID: "GTM-P99BZNFS"
    }
  },
  modules: [
    "@formkit/nuxt",
    "@vueuse/nuxt",
    '@nuxtjs/tailwindcss',
    '@nuxtjs/color-mode'
  ],
  colorMode: {
    classSuffix: ''
  },
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
});