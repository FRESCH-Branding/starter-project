<template>
  <template v-if="!formSubmitSuccess">
    <FormDefault :submit="submitForm" />
    <div>
      <p>
        Deze site wordt beschermd door reCAPTCHA en het
        <a href="https://policies.google.com/privacy" target="_blank">
          privacybeleid
        </a>
        en de
        <a href="https://policies.google.com/terms" target="_blank">
          servicevoorwaarden
        </a>
        van Google
      </p>
    </div>
  </template>

  <template v-else>
    <div id="form-submitted">
      <h2>
        {{ `form.thank_you.title` }}
      </h2>
      <p>
        {{ `form.thank_you.text` }}
      </p>
    </div>
  </template>
</template>

<script setup lang="ts">
import type { FormKitNode } from "@formkit/core";
import { useReCaptcha } from "vue-recaptcha-v3";

let formSubmitSuccess = ref(false);

const recaptchaInstance = useReCaptcha();
const recaptcha = async () => {
  await recaptchaInstance?.recaptchaLoaded();
  return await recaptchaInstance?.executeRecaptcha("login");
};

const submitForm = async (data: any, node: FormKitNode | undefined) => {
  node?.clearErrors();

  data.recaptcha = await recaptcha();

  const formData = new FormData();

  for (const key in data) {
    if (data.hasOwnProperty(key)) {
      formData.append(key, data[key]);
    }
  }

  // const fetchUrl = "/contactform-handler/";
  // const fetchUrl = "https://jordy.flyingkiwi.dev/gotiles-phpmailer/";
  const fetchUrl = "https://freschbranding.nl/contactform-handler/";

  const response: any = await useFetch(fetchUrl, {
    method: "post",
    body: formData,
  });

  const responseData = JSON.parse(response.data.value);

  if (responseData.success == true) {
    formSubmitSuccess.value = true;
  } else {
    node?.setErrors(responseData.errorMessage);
    console.log(responseData);
  }
};
</script>
