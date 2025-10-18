import axios from "axios";
import {createApp} from 'vue';
import Wizard from "./Components/Wizard.vue";
import {ZiggyVue} from '@/vendor/tightenco/ziggy/dist/index.js';
import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const app = createApp();

// Define Wizard component for the created app.
app.component('Wizard', Wizard);

// use ZiggyVue to allow vue access and use Laravel routes as blade way.
app.use(ZiggyVue).use(Vue3Toastify);

// Mount the vue
app.mount('#client-wizard')