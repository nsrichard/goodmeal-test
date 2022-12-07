import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import axios from 'axios'
import "./assets/tailwind.css";

const app = createApp(App);

app.use(router);

axios.defaults.baseURL = 'https://server.local';

app.mount("#app");