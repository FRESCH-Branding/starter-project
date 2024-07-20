<template>
  <FormKit
    name="contact"
    type="form"
    :submit-attrs="{}"
    submit-label="verzenden"
    @submit="submit"
    #default="{ state }"
  >
    <FormKit
      type="text"
      name="name"
      id="name"
      label="Naam"
      validation="required"
      validation-visibility="dirty"
    />
    <FormKit
      type="email"
      name="email"
      id="email"
      label="EMAIL"
      validation="required|*email"
      validation-visibility="dirty"
    />
    <FormKit
      type="tel"
      name="phone"
      id="phone"
      label="TELEFOON"
      validation="required"
      validation-visibility="dirty"
    />

    <FormKit
      type="textarea"
      name="message"
      id="message"
      rows="4"
      outer-class="optional-label"
      label="BERICHT"
    />
    <FormKit
      type="checkbox"
      name="privacy"
      id="privacy"
      :value="false"
      validation="accepted"
      validation-visibility="dirty"
      :validation-messages="{ accepted: 'Accepteer het privacybeleid' }"
    >
      <template #label>
        Ik ga akkoord met het&nbsp;<NuxtLink
          :to="`/privacybeleid`"
          target="_blank"
          ariaCurrentValue="page"
          >privacybeleid</NuxtLink
        >.
      </template>
    </FormKit>
  </FormKit>
</template>

<script setup lang="ts">
const props = defineProps<{
  submit: any;
}>();
</script>
