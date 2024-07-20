import type { Config } from 'tailwindcss'

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: "rgb(var(--color-primary))",
        secondary: "rgb(var(--color-secondary))",

        light: "rgb(var(--color-light))",
        dark: "rgb(var(--color-dark))",
      },
      // fontFamily: {
      //   primary: [""],
      //   secondary: [""],
      // }
    },
  },
  plugins: [],
}

export default <Partial<Config>>{
  darkMode: 'class'
}