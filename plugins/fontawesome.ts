import { defineNuxtPlugin } from "#app";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";

export default defineNuxtPlugin((nuxtApp) => {
  library.add(fas, far);

  nuxtApp.vueApp.component("FontAwesomeIcon", FontAwesomeIcon);
});
