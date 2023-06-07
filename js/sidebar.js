// sidebar.js

// Function to generate the sidebar HTML
function generateSidebar() {
  const sidebar = document.createElement("section");
  sidebar.id = "sidebar";

  const brandLink = document.createElement("a");
  brandLink.href = "dashboard.html";
  brandLink.classList.add("brand");

  const brandIcon = document.createElement("span");
  brandIcon.classList.add("icon");
  brandIcon.style.backgroundImage = "url('img/Megawide_Corporation_logo.png')";

  // Append elements to build the sidebar
  brandLink.appendChild(brandIcon);
  sidebar.appendChild(brandLink);

  // Append the sidebar to the body of the HTML document
  document.body.appendChild(sidebar);
}

// Function to generate the navbar HTML
function generateNavbar() {
  const navbar = document.createElement("nav");
  navbar.id = "navbar";

  // ... Add navbar content and structure here

  // Append the navbar to the body of the HTML document
  document.body.appendChild(navbar);
}

// Call the functions to generate the sidebar and navbar when the page loads
window.addEventListener("load", function () {
  generateSidebar();
  generateNavbar();
});
