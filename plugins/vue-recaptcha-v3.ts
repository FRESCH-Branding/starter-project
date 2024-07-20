import { VueReCaptcha } from 'vue-recaptcha-v3'

export default defineNuxtPlugin((nuxtApp) => {
    nuxtApp.vueApp.use(VueReCaptcha, {
        siteKey: '6LdoymApAAAAAER9XCtnjNeqMWS68bfSgmKlsh2T',
        loaderOptions: {
          useRecaptchaNet: true,
          autoHideBadge: true
        }
      })
})