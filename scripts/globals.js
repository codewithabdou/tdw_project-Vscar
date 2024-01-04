$(document).ready(function () {
  $("#searchUserInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("table tbody tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
  $("#searchVehiculeInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("table tbody tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });
});



function activateUser(id) {
  $.ajax({
    url: "/vscar/api/user/activateUser.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function deactivateUser(id) {
  $.ajax({
    url: "/vscar/api/user/deactivateUser.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function deleteUser(id) {
  $.ajax({
    url: "/vscar/api/user/deleteUser.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function blockUser(id) {
  $.ajax({
    url: "/vscar/api/user/blockUser.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function unblockUser(id) {
  $.ajax({
    url: "/vscar/api/user/unblockUser.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

document.addEventListener("DOMContentLoaded", function (event) {
  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId);

    // Validate that all variables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener("click", () => {
        // show navbar
        nav.classList.toggle("show");
        // change icon
        toggle.classList.toggle("bx-x");
        // add padding to body
        bodypd.classList.toggle("body-pd");
        // add padding to header
        headerpd.classList.toggle("body-pd");
      });
    }
  };

  showNavbar("header-toggle", "nav-bar", "body-pd", "header");

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll(".nav_link");

  function colorLink() {
    if (linkColor) {
      linkColor.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  }
  linkColor.forEach((l) => l.addEventListener("click", colorLink));

  // Your code to run since DOM is loaded and ready
});
