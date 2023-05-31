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
});

// Calendar Script
const calendar = {
  renderCalendar: () => {
    const today = new Date();
    let year = today.getFullYear();
    let month = today.getMonth();

    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const monthYear = document.querySelector(".month-year");
    monthYear.textContent = `${calendar.getMonthName(month)} ${year.toString()}`;

    const daysContainer = document.querySelector(".days");
    daysContainer.innerHTML = "";

    for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
      const emptyDiv = document.createElement("div");
      daysContainer.appendChild(emptyDiv);
    }

    for (let i = 1; i <= daysInMonth; i++) {
      const day = document.createElement("div");
      day.textContent = i;
      daysContainer.appendChild(day);

      if (i === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
        day.classList.add("today");
      }
    }
  },

  getMonthName: (monthIndex) => {
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return months[monthIndex];
  },

  init: () => {
    const prevButton = document.querySelector(".prev-button");
    prevButton.addEventListener("click", () => {
      calendar.prevMonth();
    });

    const nextButton = document.querySelector(".next-button");
    nextButton.addEventListener("click", () => {
      calendar.nextMonth();
    });

    calendar.renderCalendar();
  },

  prevMonth: () => {
    const monthYear = document.querySelector(".month-year");
    let [month, year] = monthYear.textContent.split(" ");

    month = calendar.getMonthIndex(month) - 1;
    if (month < 0) {
      year = parseInt(year) - 1;
      month = 11;
    }
    monthYear.textContent = `${calendar.getMonthName(month)} ${year}`;
    calendar.renderCalendar();
  },

  nextMonth: () => {
    const monthYear = document.querySelector(".month-year");
    let [month, year] = monthYear.textContent.split(" ");

    month = calendar.getMonthIndex(month) + 1;
    if (month > 11) {
      year = parseInt(year) + 1;
      month = 0;
    }
    monthYear.textContent = `${calendar.getMonthName(month)} ${year}`;
    calendar.renderCalendar();
  },

  getMonthIndex: (monthName) => {
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return months.indexOf(monthName);
  },
};

calendar.init();
