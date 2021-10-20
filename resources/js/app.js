/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance.
 * Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import { createApp } from 'vue'
const app = createApp({});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Automatically import all the outline icons.
Object.entries(require("@heroicons/vue/outline")).map(entry => {
    app.component('Outline' + entry[0], entry[1]);
});

// Automatically import all the solid icons.
Object.entries(require("@heroicons/vue/solid")).map(entry => {
    app.component('Solid' + entry[0], entry[1]);
});

import ExampleComponent from './components/ExampleComponent.vue';
app.component("ExampleComponent", ExampleComponent);

/**
 * Next, we will attach the Vue instance to the page.
 */

app.mount('#app');
