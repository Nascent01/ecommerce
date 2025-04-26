import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const modules = import.meta.glob('./*.js');
for (const path in modules) {
    if (path !== './app.js') {
        modules[path]();
    }
}

const subModules = import.meta.glob('./**/*.js');
for (const path in subModules) {
    subModules[path]();
}