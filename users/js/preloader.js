document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    var loader = document.querySelector(".loader");
    loader.style.transition = "opacity 1s"; // Change the transition duration to 0.5s
    loader.style.opacity = 0;

    setTimeout(function () {
      loader.style.display = "none"; // Set the lodaer's display property to "none"
    }, 1000); // Adjust the delay as needed
  }, 1000); // Adjust the delay as needed
});
