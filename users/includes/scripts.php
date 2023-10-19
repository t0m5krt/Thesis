<script src="js/script.js"></script>
<script src="js/preloader.js"></script>
<script src="js/favicon.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf"></script>
<script>
    //To prevent user from entering non-numeric characters
    document.getElementById('contactnumber').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });
</script>

<script>
    // Toggle Hide Password

    // Get references to the toggle icons for password and confirm password
    const passwordToggle = document.querySelector("#togglePassword");
    const confirmToggle = document.querySelector("#toggleConfirmPassword");

    // Get references to the password and confirm password input fields
    const password = document.querySelector("#password");
    const confirmPassword = document.querySelector("#confirm_pass");

    // Add a click event listener to the password toggle icon
    passwordToggle.addEventListener("click", function() {
        // Call the function to toggle password visibility, passing the password field and the icon
        togglePasswordVisibility(password, this);
    });

    // Add a click event listener to the confirm password toggle icon
    confirmToggle.addEventListener("click", function() {
        // Call the function to toggle password visibility, passing the confirm password field and the icon
        togglePasswordVisibility(confirmPassword, this);
    });

    // Function to toggle password visibility
    function togglePasswordVisibility(inputField, icon) {
        // Check the current input type of the field
        const type = inputField.getAttribute("type") === "password" ? "text" : "password";
        // Set the input type to the opposite type (text or password)
        inputField.setAttribute("type", type);

        // Toggle the appearance of the icon classes to switch between open and closed eye icons
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
    }

    // prevent form submit
    const form = document.querySelector("form");
    form.addEventListener("submit", function(e) {
        e.preventDefault();
    });
</script>