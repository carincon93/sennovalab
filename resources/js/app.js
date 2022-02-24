// import Alpine from 'alpinejs';
import { addMessages, init } from 'svelte-i18n'
import { createInertiaApp } from '@inertiajs/inertia-svelte'
import { InertiaProgress } from '@inertiajs/progress'
import es from '../lang/es.json'

// window.Alpine = Alpine;

// Alpine.start();

addMessages('es', es)

init({
    initialLocale: 'es',
})

InertiaProgress.init({ color: '#f98e3c' })

createInertiaApp({
  resolve: name => require(`./Pages/${name}.svelte`),
  setup({ el, App, props }) {
    new App({ target: el, props })
  },
})
