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
// const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

// TOOGLE HIDE SIDEBAR ON RESIZE
window.addEventListener("resize", function () {
  if (this.innerWidth <= 768) {
    sidebar.classList.add("hide");
  } else {
    sidebar.classList.remove("hide");
  }
});

const searchButton = document.querySelector("#content nav form .form-input button");
const searchButtonIcon = document.querySelector("#content nav form .form-input button .bx");
const searchForm = document.querySelector("#content nav form");

searchButton.addEventListener("click", function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchForm.classList.toggle("show");
    if (searchForm.classList.contains("show")) {
      searchButtonIcon.classList.replace("bx-search", "bx-x");
    } else {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
    }
  }
});

if (window.innerWidth < 768) {
  sidebar.classList.add("hide");
} else if (window.innerWidth > 576) {
  searchButtonIcon.classList.replace("bx-x", "bx-search");
  searchForm.classList.remove("show");
}

window.addEventListener("resize", function () {
  if (this.innerWidth > 576) {
    searchButtonIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
  }

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
});
