const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const profileIcon = document.querySelector("#content nav .profile-icon");

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");

  if (window.innerWidth <= 768) {
    sidebar.classList.add("hide");
  } else {
    sidebar.classList.remove("hide");
  }

  // HIDE PROFILE ICON BEFORE 480PX
  if (window.innerWidth < 480) {
    profileIcon.classList.add("hide");
  } else {
    profileIcon.classList.remove("hide");
  }
}

// TOGGLE SIDEBAR
menuBar.addEventListener("click", function () {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("hide");
});

// Handle side menu clicks
allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// Initial setup
toggleSidebar();

// Add event listener for window resize
window.addEventListener("resize", toggleSidebar);
