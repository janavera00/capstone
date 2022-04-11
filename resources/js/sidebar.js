function doToggleSidebar() {   
    let sidebar = document.querySelector(".sidebar");
    let sidebarButton = document.querySelector(".sidebar-button");
    let isActive = JSON.parse(sidebar.getAttribute("data-active"));

    sidebar.setAttribute("data-active", (!isActive).toString());
    sidebarButton.setAttribute("data-active", (!isActive).toString());
}