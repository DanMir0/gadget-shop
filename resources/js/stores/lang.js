import {defineStore} from "pinia";

export const useLangStore = defineStore('lang', {
    state: () => ({
        currentLang: 'ru',
        availableLangs: ['ru', 'en']
    }),
    actions: {
        setLang(lang) {
            if (this.availableLangs.includes(lang)) {
                this.currentLang = lang
            }
        }
    }
})
