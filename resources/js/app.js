import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Book from './components/Book.vue';
import UploadFile from './components/UploadFile.vue';

const app = createApp({});
app.component('book', Book);
app.component('upload-file', UploadFile);
app.mount('#app');
const lang = document.getElementsByTagName('html')[0].getAttribute('lang');
if (lang) {
    window.lang = lang;
}