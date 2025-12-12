document.addEventListener("DOMContentLoaded", function () {
    // Toggle Sidebar
    const toggleNav = document.getElementById("toggle-nav");
    const navDash = document.getElementById("nav-dash");
    
    if (toggleNav && navDash) {
        toggleNav.addEventListener("click", function () {
            navDash.classList.toggle("w-64");
            navDash.classList.toggle("w-0");
        });
    }

    // Toggle Submenus
    document.querySelectorAll(".submenu-button").forEach(button => {
        button.addEventListener("click", function () {
            let submenu = this.nextElementSibling;
            if (submenu) submenu.classList.toggle("hidden");
        });
    });

    // CKEditor
    if (document.querySelector("#editor")) {
        ClassicEditor.create(document.querySelector("#editor"), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                '|', 'undo', 'redo', '|', 'alignment', 'imageUpload', 'mediaEmbed', 'codeBlock'
            ],
            height: 400,
        }).then(editor => {
            document.querySelector("form").addEventListener("submit", function () {
                document.querySelector("#desc").value = editor.getData();
            });

            const editorElement = document.querySelector(".ck-editor__editable");
            editorElement.style.resize = "both";
            editorElement.style.overflow = "auto";
        }).catch(error => console.error(error));
    }

    // Notification Menu
    const notifButton = document.getElementById("notif-button");
    const notifMenu = document.getElementById("notif-menu");
    if (notifButton && notifMenu) {
        notifButton.addEventListener("click", function (event) {
            notifMenu.classList.toggle("hidden");
            event.stopPropagation();
        });
        document.addEventListener("click", function () {
            notifMenu.classList.add("hidden");
        });
        notifMenu.addEventListener("click", function (event) {
            event.stopPropagation();
        });
    }

    function timeAgo(timestamp) {
        const now = new Date();
        const then = new Date(timestamp);
        const seconds = Math.floor((now - then) / 1000);

        if (seconds < 60) return `${seconds} detik lalu`;
        const minutes = Math.floor(seconds / 60);
        if (minutes < 60) return `${minutes} menit lalu`;
        const hours = Math.floor(minutes / 60);
        if (hours < 24) return `${hours} jam lalu`;
        const days = Math.floor(hours / 24);
        if (days < 7) return `${days} hari lalu`;
        const weeks = Math.floor(days / 7);
        if (weeks < 4) return `${weeks} minggu lalu`;
        const months = Math.floor(days / 30);
        if (months < 12) return `${months} bulan lalu`;
        const years = Math.floor(days / 365);
        return `${years} tahun lalu`;
    }

    function fetchNotifications() {
        fetch(window.appRoutes.fetchNotifications)
            .then(response => response.json())
            .then(data => {
                const notifContent = document.getElementById("notif-content");
                const notifCount = document.getElementById("notif-count");
    
                if (data.length > 0) {
                    notifCount.textContent = data.length;
                    notifCount.classList.remove("hidden");
    
                    notifContent.innerHTML = `<div class="p-2 font-bold text-lg text-gray-700 border-b">Pendaftar Baru</div>`;
    
                    const displayedNotifications = data.slice(0, 10);
                    
                    displayedNotifications.forEach(reg => {
                        notifContent.innerHTML += `
                            <div class="p-2 border-b relative">
                                <p class="text-sm font-bold">${truncateText(reg.nama, 25)}</p>
                                <p class="text-xs text-gray-500">${truncateText(reg.asal_sekolah, 25)}</p>

                                <!-- timestamp pojok kanan bawah -->
                                <span class="absolute bottom-1 right-2 text-[10px] text-gray-400">
                                    ${timeAgo(reg.created_at)}
                                </span>
                            </div>
                        `;
                    });
    
                    if (data.length > 10) {
                        notifContent.innerHTML += `<div class="p-2 text-center text-gray-500">+${data.length - 10} Notifikasi</div>`;
                    }
                } else {
                    notifCount.classList.add("hidden");
                    notifContent.innerHTML = `<p class="text-gray-500 text-center p-2">Tidak ada notifikasi</p>`;
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }
    
    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
    }
    
    setInterval(fetchNotifications, 10000);
    fetchNotifications();    

    // User Menu
    const userMenuButton = document.getElementById("user-menu-button");
    const userMenu = document.getElementById("user-menu");
    if (userMenuButton && userMenu) {
        userMenuButton.addEventListener("click", function (event) {
            event.stopPropagation();
            userMenu.classList.toggle("hidden");
        });
        document.addEventListener("click", function (event) {
            if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.add("hidden");
            }
        });
    }
});
