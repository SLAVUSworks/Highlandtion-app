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
                    
                    data.forEach(reg => {
                        notifContent.innerHTML += `<div class="p-2 border-b">
                            <p class="text-sm font-bold">${truncateText(reg.nama, 25)}</p>
                            <p class="text-xs text-gray-500">${truncateText(reg.asal_sekolah, 25)}</p>
                        </div>`;
                    });
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
