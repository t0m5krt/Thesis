// Added favicon on all stages

document.addEventListener("DOMContentLoaded", function () {
  var link = document.createElement("link");
  link.rel = "icon";
  link.type = "image/x-icon";
  link.href = "img/favicon.png";

  var head = document.querySelector("head");
  head.appendChild(link);
});
