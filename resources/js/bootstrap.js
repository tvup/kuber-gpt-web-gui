import _ from 'lodash';
window._ = _;

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import * as Popper from '@popperjs/core';
window.Popper = Popper;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import * as Bootstrap from 'bootstrap';
window.bootstrap = Bootstrap;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

import Swal from 'sweetalert2';
window.Swal = Swal;

import Pusher from 'pusher-js';

let backendBaseUrl = import.meta.env.BASE_URL;

var pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    authEndpoint: `${backendBaseUrl}/broadcasting/auth`,
    auth: {
        headers: {
            "Authorization": "Bearer bPOZyMpJ1GDsS8cAO3ZmM8zJEwz0RXE1sAHWyqSb",
        }
    }
})



window.Pusher = pusher;


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
