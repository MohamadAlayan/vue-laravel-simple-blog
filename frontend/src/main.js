import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";

import 'bootstrap/scss/bootstrap.scss';
import 'bootstrap'; // for modals
import './assets/scss/style.scss';
import FontAwesomeIcon from "@/assets/icons/fontawesome-icons";
import store from "./store";


const app = createApp(App);

app.use(router);
app.use(store);
app.component("font-awesome-icon", FontAwesomeIcon)
app.mount("#app");
