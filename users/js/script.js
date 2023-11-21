// const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
// const menuBar = document.querySelector("#content nav .bx.bx-menu");
// const sidebar = document.getElementById("sidebar");
// const subMenu = document.getElementById("sidebar .sub-menu");
// const searchButton = document.querySelector("#content nav form .form-input button");
// const searchButtonIcon = document.querySelector("#content nav form .form-input button .bx");
// const searchForm = document.querySelector("#content nav form");

// function hideSidebarOnResize() {
//   if (window.innerWidth <= 767) {
//     sidebar.classList.add("hide");
//   } else {
//     sidebar.classList.remove("hide");
//   }
// }

// // Initial setup
// hideSidebarOnResize();

// // TOGGLE SIDEBAR
// menuBar.addEventListener("click", function () {
//   sidebar.classList.toggle("hide");
// });

// // Handle side menu clicks
// allSideMenu.forEach((item) => {
//   const li = item.parentElement;

//   item.addEventListener("click", function () {
//     allSideMenu.forEach((i) => {
//       i.parentElement.classList.remove("active");
//     });
//     li.classList.add("active");
//   });
// });

// // Event listener for window resize
// window.addEventListener("resize", function () {
//   hideSidebarOnResize();

//   if (window.innerWidth > 576) {
//     searchButtonIcon.classList.replace("bx-x", "bx-search");
//     searchForm.classList.remove("show");
//   }
// });

const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
const searchButton = document.querySelector("#content nav form .form-input button");
const searchButtonIcon = document.querySelector("#content nav form .form-input button .bx");
const searchForm = document.querySelector("#content nav form");

function toggleSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("hide");
  } else {
    sidebar.classList.remove("hide");
  }
}

function hideSidebarOnResize() {
  const isSidebarHidden = window.innerWidth <= 767;

  if (isSidebarHidden) {
    if (!sidebar.classList.contains("hide")) {
      sidebar.classList.add("hide");
    }
  } else {
    sidebar.classList.remove("hide");
  }
}

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

// TOGGLE SIDEBAR
menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

// TOGGLE HIDE SIDEBAR ON RESIZE
window.addEventListener("resize", function () {
  toggleSidebar();

  if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
  }
});

toggleSidebar(); // Toggle sidebar on load

function responsiveNavbar() {
  const navbar = document.querySelector("#content nav"); // Get element by id
  const profileText = document.querySelector(".profile-text"); // Get element by class
  const profileIcon = document.querySelector(".profile-icon"); // Get element by class

  if (window.innerWidth <= 425) {
    navbar.classList.add("hide");
    profileText.style.display = "none"; // Hide profile-text
  } else {
    navbar.classList.remove("hide");
    profileText.style.display = "block"; // Show profile-text
  }

  if (window.innerWidth <= 425) {
    navbar.classList.add("hide");
    profileIcon.style.display = "block"; // Show profile-icon
  } else {
    navbar.classList.remove("hide");
    profileIcon.style.display = "none"; // Hide profile-icon
  }
}

responsiveNavbar(); // responsive navbar on load
