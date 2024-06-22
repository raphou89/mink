import './bootstrap';

import { createApp } from 'vue';

import AnimalsIndex from './components/animals/Index.vue';
import Admin from './components/admin/Index.vue';

createApp(AnimalsIndex).mount('#user');
createApp(Admin).mount('#admin');
