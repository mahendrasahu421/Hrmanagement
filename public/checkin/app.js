let deferredPrompt;
const installBtn = document.getElementById("installBtn");

window.addEventListener("beforeinstallprompt", (e) => {
    e.preventDefault();
    deferredPrompt = e;
    installBtn.style.display = "block";
});

installBtn.addEventListener("click", async () => {
    if (!deferredPrompt) {
        alert("Install option available nahi hai.");
        return;
    }

    deferredPrompt.prompt();
    const result = await deferredPrompt.userChoice;

    console.log("Result:", result.outcome);
    deferredPrompt = null;
    installBtn.style.display = "none";
});

function checkIn() {
    document.getElementById("status").innerText =
        "Checked In at: " + new Date().toLocaleTimeString();
}

function checkOut() {
    document.getElementById("status").innerText =
        "Checked Out at: " + new Date().toLocaleTimeString();
}

if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/checkin/service-worker.js")
        .then(() => console.log("Service worker registered"))
        .catch(err => console.log("SW failed", err));
}
