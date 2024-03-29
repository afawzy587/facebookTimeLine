    import './bootstrap';
    import '../css/app.css';

    import { createApp, h } from 'vue';
    import { createInertiaApp } from '@inertiajs/vue3';
    import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
    import { ZiggyVue } from '../../vendor/tightenco/ziggy';
    import { createI18n } from 'vue-i18n';
    import enLocale from '../lang/en.json';
    import arLocale from '../lang/ar.json';
    import { createPinia } from 'pinia'
    import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
    

    const pinia = createPinia()
    pinia.use(piniaPluginPersistedstate)

    const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
    const i18n = createI18n({
        legacy: false, 
        locale: window.__locale,
        messages: {
            en: enLocale,
            ar: arLocale
        }
    });

    createInertiaApp({
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            return createApp({ render: () => h(App, props) })
                .use(plugin)
                .use(pinia)
                .use(ZiggyVue)
                .use(i18n)
                .mount(el);
        },
        progress: {
            color: '#4B5563',
        },
    });
