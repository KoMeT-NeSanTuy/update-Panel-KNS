</div> <!-- tutup content -->

<script>
// SIDEBAR
function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let content = document.getElementById("content");

    if (window.innerWidth < 768) {
        sidebar.classList.toggle("show");
    } else {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("full");
    }
}

// SUBMENU
function toggleMenu(id){
    document.getElementById(id).classList.toggle("show");
}

// DARK MODE
function toggleDarkMode(){
    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark")){
        localStorage.setItem("theme","dark");
    } else {
        localStorage.setItem("theme","light");
    }

    updateIcon();
}

// ICON MODE
function updateIcon(){
    let btn = document.getElementById("btnTheme");

    if(document.body.classList.contains("dark")){
        btn.innerHTML = '<i class="bi bi-sun"></i>';
    } else {
        btn.innerHTML = '<i class="bi bi-moon"></i>';
    }
}

// AUTO LOAD
window.onload = function(){
    let page = "<?= basename($_SERVER['PHP_SELF']) ?>";

    if(page == "pelanggan.php" || page == "map.php"){
        document.getElementById("crm").classList.add("show");
    }

    if(localStorage.getItem("theme") === "dark"){
        document.body.classList.add("dark");
    }

    updateIcon();
}
</script>

</body>
</html>
