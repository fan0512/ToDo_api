import './bootstrap';

import { createApp } from 'vue';
import App from './vue/app.vue';
import { library } from "@fortawesome/fontawesome-svg-core"
import { faPlusSquare, faTrash , faEdit, faCheck, faCancel } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faPlusSquare, faTrash, faEdit, faCheck, faCancel)

export const eventBus = createApp(App);

createApp(App).component('font-awesome-icon', FontAwesomeIcon).mount('#app');

