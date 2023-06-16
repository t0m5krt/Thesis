Swal.fire({
  icon: "error",
  title: "Invalid",
  text: "Invalid username or password!",
  onClose: function () {
    window.location.href = "admin_login.php";
  },
});
