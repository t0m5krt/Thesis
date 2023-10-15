
//Calendar Script
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
  
  // end of calendar