import io from "socket.io-client";

import Echo from "laravel-echo";

window.io = io;

window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ":6001",
    transports: ["websocket"],
})
    .channel(`translation.1`)
    .listen("TranslationEvent", (e) => {
        console.log(e.order);
    });
