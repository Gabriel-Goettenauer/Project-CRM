import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import 'bootstrap-icons/font/bootstrap-icons.css';


const app = createApp(App)

const options = {
    this.$toast.success("I'm a toast!", {
        position: "top-center",
        timeout: 5000,
        closeOnClick: false,
        pauseOnFocusLoss: true,
        pauseOnHover: false,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: true,
        hideProgressBar: true,
        closeButton: "button",
        icon: true,
        rtl: false
    }
};

app.use(router)
app.use(store)
app.use(Toast, options);

app.mount('#app')
