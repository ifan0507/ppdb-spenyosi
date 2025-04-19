import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});

window.Echo.private("admin-channel").listen("SiswaBaruMendaftar", (e) => {
    console.log("Notifikasi masuk!", e);

    // 1. Update jumlah badge
    const notifCount = document.getElementById("notification-count");
    if (notifCount) {
        let count = parseInt(notifCount.innerText) || 0;
        count += 1;
        notifCount.innerText = count;
        notifCount.style.display = "inline-block";
    }

    // 2. Update isi dropdown notifikasi
    const container = document.getElementById("notification-container");

    if (container) {
        // Hapus notif kosong (jika ada)
        const emptyText = container.querySelector(
            ".notification-item.text-center"
        );
        if (emptyText) emptyText.remove();

        // Tambahkan notifikasi baru di atas
        const newItem = document.createElement("li");
        newItem.classList.add("notification-item");
        newItem.innerHTML = `
            <i class="bi bi-person-plus text-success"></i>
            <div>
                <h4>${e.siswa?.register?.siswa?.nama || "Siswa Baru"}</h4>
                <p>No. Register: ${e.siswa?.register?.no_register || "-"}</p>
                <p class="text-muted small">Baru saja</p>
            </div>
        `;

        const divider = document.createElement("li");
        divider.innerHTML = `<hr class="dropdown-divider">`;

        // Sisipkan tepat setelah elemen judul (dropdown-header)
        const header = container.querySelector(".dropdown-header");
        if (header && header.parentNode) {
            header.innerHTML = `You have ${parseInt(
                notifCount.innerText
            )} new notifications <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>`;
            header.parentNode.insertBefore(divider, header.nextSibling);
            header.parentNode.insertBefore(newItem, divider);
        }
    }
});
