document.addEventListener("DOMContentLoaded", function () {
  var typeOfRequest = document.getElementById("type-of-request");
  var additionalOptionGroup = document.getElementById("additional-option-group");
  var otherServiceRequestInput = document.getElementById("other-service-request-input");

  typeOfRequest.addEventListener("change", function () {
    if (typeOfRequest.value === "serviceRequest") {
      additionalOptionGroup.style.display = "flex";
    } else {
      additionalOptionGroup.style.display = "none";
    }

    // Reset other service request input if option is changed
    otherServiceRequestInput.style.display = "none";
  });

  var additionalOptionServiceRequest = document.getElementById("additional-option-service-request");
  additionalOptionServiceRequest.addEventListener("change", function () {
    if (additionalOptionServiceRequest.value === "other") {
      otherServiceRequestInput.style.display = "flex";
    } else {
      otherServiceRequestInput.style.display = "none";
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var labels = document.querySelectorAll("label");

  labels.forEach(function (label) {
    var input = document.querySelector('input[name="' + label.getAttribute("for") + '"]');
    if (input) {
      input.placeholder = label.innerText;
    }
  });
});
