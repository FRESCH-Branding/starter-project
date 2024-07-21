import type { Config } from "tailwindcss";

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
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
      fontSize: {
        10: "1rem",
        11: "1.1rem",
        12: "1.2rem",
        13: "1.3rem",
        14: "1.4rem",
        15: "1.5rem",
        16: "1.6rem",
        17: "1.7rem",
        18: "1.8rem",
        19: "1.9rem",
        20: "2rem",
        21: "2.1rem",
        22: "2.2rem",
        24: "2.4rem",
        26: "2.6rem",
        27: "2.7rem",
        28: "2.8rem",
        29: "2.9rem",
        30: "3rem",
        40: "4rem",
        50: "5rem",
        60: "6rem",
      },
      lineHeight: {
        10: "1rem",
        11: "1.1rem",
        12: "1.2rem",
        13: "1.3rem",
        14: "1.4rem",
        15: "1.5rem",
        16: "1.6rem",
        17: "1.7rem",
        18: "1.8rem",
        19: "1.9rem",
        20: "2rem",
        21: "2.1rem",
        22: "2.2rem",
        24: "2.4rem",
        26: "2.6rem",
        27: "2.7rem",
        28: "2.8rem",
        29: "2.9rem",
        30: "3rem",
        40: "4rem",
        50: "5rem",
        60: "6rem",
      },
    },
  },
  plugins: [],
};

export default <Partial<Config>>{
  darkMode: "class",
};
