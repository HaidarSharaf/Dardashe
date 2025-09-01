import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'reverb',
  wsHost: 'ws.dardashe.site',
  forceTLS: true,
  enabledTransports: ['ws', 'wss'],
});
