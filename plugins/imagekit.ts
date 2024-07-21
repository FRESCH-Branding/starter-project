import { defineNuxtPlugin } from "#app";

export default defineNuxtPlugin((nuxtApp) => {
  const config = useRuntimeConfig();

  // Accessing public and private runtime config variables
  const imageKitPublicKey = config.public.imagekitPublicKey;
  const imageKitPrivateKey = config.imagekitPrivateKey;
  const imageKitUrlEndpoint = config.public.imagekitUrlEndpoint;

  // Configure ImageKit
  const imageKitConfig = {
    publicKey: imageKitPublicKey,
    privateKey: imageKitPrivateKey,
    urlEndpoint: imageKitUrlEndpoint,
  };

  // Provide the ImageKit configuration globally
  nuxtApp.provide("imageKit", imageKitConfig);
});
