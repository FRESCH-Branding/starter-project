import { gsap } from "gsap";
    
import { Flip } from "gsap/Flip";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { TextPlugin } from "gsap/TextPlugin";

export default defineNuxtPlugin((nuxtApp) => {
    gsap.registerPlugin(Flip,ScrollTrigger,TextPlugin);

    return {
        provide: {
            gsap,
        }
    }
})