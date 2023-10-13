import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './index.css'
import Colada, { PiniaColadaPlugin } from 'colada-plugin';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faUser, faPenToSquare, faTrash } from "@fortawesome/free-solid-svg-icons";

library.add(faPenToSquare,faTrash)

import i18n from "./lang"

const app = createApp(App)
const pinia = createPinia();

app.component("FontAwesomeIcon", FontAwesomeIcon)
app.use(pinia);
pinia.use(PiniaColadaPlugin);
app.use(Colada);
app.use(router)
app.use(i18n)

app.mount('#app')
