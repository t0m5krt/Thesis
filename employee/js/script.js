const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

if (this.innerWidth <= 768) {
  sidebar.classList.add("hide");
}

if (this.innerWidth > 768) {
  sidebar.classList.remove("hide");
}
// HIDE PROFILE ICON BEFORE 480PX
const profileIcon = document.querySelector("#content nav .profile-icon");
if (this.innerWidth < 480) {
  profileIcon.classList.add("hide");
} else {
  profileIcon.classList.remove("hide");
}

//toggle submenu in sidebar
const allSubMenu = document.querySelectorAll("#sidebar .side-menu .sub-menu");

allSubMenu.forEach((item) => {
  const li = item.parentElement;

  item.previousElementSibling.addEventListener("click", function (e) {
    e.preventDefault();
    item.style.display = "block";
    li.classList.toggle("show");
  });
}); // <-- added closing parenthesis
