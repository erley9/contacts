import { createI18n } from 'vue-i18n'
import en from "./langs/en"
import pt from "./langs/pt"


const defaultLanguage = 'en';

const messages = {
    pt,
    en
}

export default createI18n({
    locale: defaultLanguage,
    messages,
    globalInjection: true,
    legacy: false
})