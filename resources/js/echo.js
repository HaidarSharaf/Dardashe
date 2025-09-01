import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
  broadcaster: 'reverb',
  wsHost: window.location.hostname,
  wsPath: '/app',
  forceTLS: true,
  enabledTransports: ['ws', 'wss'],
});
