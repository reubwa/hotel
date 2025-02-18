// JavaScript function to load the navbar
function loadNavbar() {
    fetch("navbar.html")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("navbar-container").innerHTML = data;
      })
      .catch((error) => console.error("Error loading navbar:", error));
  }
  