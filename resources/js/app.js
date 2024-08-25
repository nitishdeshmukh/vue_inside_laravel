import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import {ZiggyVue} from 'ziggy-js'

import { createPinia } from "pinia";
const store=createPinia();


import '../css/main.css';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Tracsis';

createInertiaApp({
  progress: {
    color: "#29d",
  },
  title: (title) => `${title} - ${appName}`,
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(store)
      .use(plugin)
      .use(ZiggyVue)
      .mount(el);
  },
});
