export default defineNuxtConfig({
  ssr: true,
  devtools: {
    enabled: false,
  },
  build: {
    transpile: ["@fortawesome/vue-fontawesome"],
  },
  css: [
    "~/assets/css/tailwind.css",
    "@fortawesome/fontawesome-svg-core/styles.css",
  ],
  runtimeConfig: {
    imagekitPrivateKey: process.env.IMAGEKIT_PRIVATE_KEY,
    public: {
      googleTagManagerID: "",
      imagekitUrlEndpoint: process.env.IMAGEKIT_URL_ENDPOINT,
      imagekitPublicKey: process.env.IMAGEKIT_PUBLIC_KEY,
    },
  },
  modules: [
    "@formkit/nuxt",
    "@vueuse/nuxt",
    "@nuxtjs/tailwindcss",
    "@nuxtjs/color-mode",
  ],
  colorMode: {
    classSuffix: "",
  },
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  plugins: ["~/plugins/imagekit.ts", "~/plugins/fontawesome.ts"],
});
