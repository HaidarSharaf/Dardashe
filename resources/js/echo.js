import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: ws.dardashe.site,
    wsPort: 8080,
    wssPort: 8080,
    forceTLS: true,
    enabledTransports: ['ws', 'wss'],
});
