import axios from "axios";
import Echo from "laravel-echo";
import io from "socket.io-client";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.io = io;

window.Echo = new Echo({
    broadcaster: "reverb",
    host: window.location.hostname + ":6001",
});
