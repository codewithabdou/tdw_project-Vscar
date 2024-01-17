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
  $("#searchVehiculesReviewsInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("table tbody tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  $("#searchNewsInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("table tbody tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  $("#statusFilter").on("change", function () {
    var selectedStatus = $(this).val().toLowerCase();
    $("table tbody tr").filter(function () {
      if (selectedStatus === "") {
        $(this).show();
      } else {
        var rowStatus = $(this).find(".status").text().toLowerCase();

        console.log("row status :", rowStatus);
        console.log("selected status :", selectedStatus);
        $(this).toggle(
          rowStatus.trim().toLowerCase() === selectedStatus.trim().toLowerCase()
        );
      }
    });
  });
  $("#Image").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".custom-file-label").text(fileName);
  });
  $("#ImageUser").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".custom-file-label").text(fileName);
  });
  $("#ImageAd").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".custom-file-label").text(fileName);
  });
  $("#ImageCar").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".custom-file-label").text(fileName);
  });
  $("#ImageBrand").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".custom-file-label").text(fileName);
  });
});

function updateModels1() {
  var selectedBrand = $("#Marque1").val();
  console.log(selectedBrand);

  var modelSelect = $("#Modèle1");

  modelSelect.empty();

  modelSelect.append(
    $("<option>", {
      value: "",
      text: "Select Model",
    })
  );

  $.ajax({
    url: "/vscar/api/brand/getBrandModel.php",
    type: "POST",
    data: { brandId: selectedBrand },
    success: function (data) {
      var models = JSON.parse(data);
      console.log(models);
      $.each(models, function (index, model) {
        modelSelect.append(
          $("<option>", {
            value: model,
            text: model,
          })
        );
      });
    },
  });
}

function updateModels2() {
  var selectedBrand = $("#Marque2").val();
  console.log(selectedBrand);

  var modelSelect = $("#Modèle2");

  modelSelect.empty();

  modelSelect.append(
    $("<option>", {
      value: "",
      text: "Select Model",
    })
  );

  $.ajax({
    url: "/vscar/api/brand/getBrandModel.php",
    type: "POST",
    data: { brandId: selectedBrand },
    success: function (data) {
      var models = JSON.parse(data);
      console.log(models);
      $.each(models, function (index, model) {
        modelSelect.append(
          $("<option>", {
            value: model,
            text: model,
          })
        );
      });
    },
  });
}

function updateModels3() {
  var selectedBrand = $("#Marque3").val();
  console.log(selectedBrand);

  var modelSelect = $("#Modèle3");

  modelSelect.empty();

  modelSelect.append(
    $("<option>", {
      value: "",
      text: "Select Model",
    })
  );

  $.ajax({
    url: "/vscar/api/brand/getBrandModel.php",
    type: "POST",
    data: { brandId: selectedBrand },
    success: function (data) {
      var models = JSON.parse(data);
      console.log(models);
      $.each(models, function (index, model) {
        modelSelect.append(
          $("<option>", {
            value: model,
            text: model,
          })
        );
      });
    },
  });
}

function updateModels4() {
  var selectedBrand = $("#Marque4").val();
  console.log(selectedBrand);

  var modelSelect = $("#Modèle4");

  modelSelect.empty();

  modelSelect.append(
    $("<option>", {
      value: "",
      text: "Select Model",
    })
  );

  $.ajax({
    url: "/vscar/api/brand/getBrandModel.php",
    type: "POST",
    data: { brandId: selectedBrand },
    success: function (data) {
      var models = JSON.parse(data);
      console.log(models);
      $.each(models, function (index, model) {
        modelSelect.append(
          $("<option>", {
            value: model,
            text: model,
          })
        );
      });
    },
  });
}

function updateYears1() {
  var selectedBrand = $("#Marque1").val();
  var selectedModel = $("#Modèle1").val();
  var selectedVersion = $("#Version1").val();
  var yearSelect = $("#Année1");
  yearSelect.empty();
  yearSelect.append(
    $("<option>", {
      value: "",
      text: "Select Year",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getVersionYear.php",
    type: "POST",
    data: {
      version: selectedVersion,
      model: selectedModel,
      brandId: selectedBrand,
    },
    success: function (data) {
      var years = JSON.parse(data);
      console.log(years);
      $.each(years, function (index, year) {
        yearSelect.append(
          $("<option>", {
            value: year,
            text: year,
          })
        );
      });
    },
  });
}

function updateYears2() {
  var selectedBrand = $("#Marque2").val();
  var selectedModel = $("#Modèle2").val();
  var selectedVersion = $("#Version2").val();
  var yearSelect = $("#Année2");
  yearSelect.empty();
  yearSelect.append(
    $("<option>", {
      value: "",
      text: "Select Year",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getVersionYear.php",
    type: "POST",
    data: {
      version: selectedVersion,
      model: selectedModel,
      brandId: selectedBrand,
    },
    success: function (data) {
      var years = JSON.parse(data);
      console.log(years);
      $.each(years, function (index, year) {
        yearSelect.append(
          $("<option>", {
            value: year,
            text: year,
          })
        );
      });
    },
  });
}

function updateYears3() {
  var selectedBrand = $("#Marque3").val();
  var selectedModel = $("#Modèle3").val();
  var selectedVersion = $("#Version3").val();
  var yearSelect = $("#Année3");
  yearSelect.empty();
  yearSelect.append(
    $("<option>", {
      value: "",
      text: "Select Year",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getVersionYear.php",
    type: "POST",
    data: {
      version: selectedVersion,
      model: selectedModel,
      brandId: selectedBrand,
    },
    success: function (data) {
      var years = JSON.parse(data);
      console.log(years);
      $.each(years, function (index, year) {
        yearSelect.append(
          $("<option>", {
            value: year,
            text: year,
          })
        );
      });
    },
  });
}

function updateYears4() {
  var selectedBrand = $("#Marque4").val();
  var selectedModel = $("#Modèle4").val();
  var selectedVersion = $("#Version4").val();
  var yearSelect = $("#Année4");
  yearSelect.empty();
  yearSelect.append(
    $("<option>", {
      value: "",
      text: "Select Year",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getVersionYear.php",
    type: "POST",
    data: {
      version: selectedVersion,
      model: selectedModel,
      brandId: selectedBrand,
    },
    success: function (data) {
      var years = JSON.parse(data);
      console.log(years);
      $.each(years, function (index, year) {
        yearSelect.append(
          $("<option>", {
            value: year,
            text: year,
          })
        );
      });
    },
  });
}

function updateVersions1() {
  var selectedBrand = $("#Marque1").val();
  var selectedModel = $("#Modèle1").val();
  var versionSelect = $("#Version1");
  versionSelect.empty();
  versionSelect.append(
    $("<option>", {
      value: "",
      text: "Select Version",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getModelVersion.php",
    type: "POST",
    data: { model: selectedModel, brandId: selectedBrand },
    success: function (data) {
      var versions = JSON.parse(data);
      console.log(versions);
      $.each(versions, function (index, version) {
        versionSelect.append(
          $("<option>", {
            value: version,
            text: version,
          })
        );
      });
    },
  });
}

function updateVersions2() {
  var selectedBrand = $("#Marque2").val();
  var selectedModel = $("#Modèle2").val();
  var versionSelect = $("#Version2");
  versionSelect.empty();
  versionSelect.append(
    $("<option>", {
      value: "",
      text: "Select Version",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getModelVersion.php",
    type: "POST",
    data: { model: selectedModel, brandId: selectedBrand },
    success: function (data) {
      var versions = JSON.parse(data);
      console.log(versions);
      $.each(versions, function (index, version) {
        versionSelect.append(
          $("<option>", {
            value: version,
            text: version,
          })
        );
      });
    },
  });
}

function updateVersions3() {
  var selectedModel = $("#Modèle3").val();
  var selectedBrand = $("#Marque3").val();
  var versionSelect = $("#Version3");
  versionSelect.empty();
  versionSelect.append(
    $("<option>", {
      value: "",
      text: "Select Version",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getModelVersion.php",
    type: "POST",
    data: { model: selectedModel, brandId: selectedBrand },
    success: function (data) {
      var versions = JSON.parse(data);
      console.log(versions);
      $.each(versions, function (index, version) {
        versionSelect.append(
          $("<option>", {
            value: version,
            text: version,
          })
        );
      });
    },
  });
}

function dropCars() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};

function updateVersions4() {
  var selectedBrand = $("#Marque4").val();
  var selectedModel = $("#Modèle4").val();
  var versionSelect = $("#Version4");
  versionSelect.empty();
  versionSelect.append(
    $("<option>", {
      value: "",
      text: "Select Version",
    })
  );
  $.ajax({
    url: "/vscar/api/brand/getModelVersion.php",
    type: "POST",
    data: { model: selectedModel, brandId: selectedBrand },
    success: function (data) {
      var versions = JSON.parse(data);
      console.log(versions);
      $.each(versions, function (index, version) {
        versionSelect.append(
          $("<option>", {
            value: version,
            text: version,
          })
        );
      });
    },
  });
}

function displayCurrentImageNews(input) {
  const currentImageDisplay = document.getElementById(
    "currentImageDisplayNews"
  );
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      currentImageDisplay.innerHTML =
        'Current Image: <img style="padding : 5px" src="' +
        e.target.result +
        '" width="40" height="40" />';
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    currentImageDisplay.innerHTML =
      'Current Image: <img src="/vscar/public/images/news/' +
      $existingNews["Image"] +
      '" width="50" height="50" />';
  }
}

function deleteContact(id) {
  $.ajax({
    url: "/vscar/api/contact/deleteContact.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function deleteAd(id) {
  $.ajax({
    url: "/vscar/api/ads/deleteAd.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function ToggleHomeAds(id) {
  $.ajax({
    url: "/vscar/api/ads/toggleHomeAds.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

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

function deleteBrand(id) {
  $.ajax({
    url: "/vscar/api/brand/deleteBrand.php",
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

function ToggleHomeNews(id) {
  $.ajax({
    url: "/vscar/api/news/toggleHomeNews.php",
    method: "POST",
    data: { id: id },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
      location.reload();
    },
  });
}

function deleteVehicule(id) {
  console.log(id);
  $.ajax({
    url: "/vscar/api/vehicule/deleteVehicule.php",
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

function deleteNews(id) {
  $.ajax({
    url: "/vscar/api/news/deleteNews.php",
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

function likeVehiculeReview(reviewId) {
  console.log(reviewId);
  $.ajax({
    url: "/vscar/api/review/likeVehiculeReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function likeBrandReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/likeBrandReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function unlikeVehiculeReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/unlikeVehiculeReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function unlikeVehicule(vehiculeId) {
  $.ajax({
    url: "/vscar/api/vehicule/unlikeVehicule.php",
    method: "POST",
    data: { id: vehiculeId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function likeBrand(brandId) {
  $.ajax({
    url: "/vscar/api/brand/likeBrand.php",
    method: "POST",
    data: { id: brandId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function unlikeBrand(brandId) {
  $.ajax({
    url: "/vscar/api/brand/unlikeBrand.php",
    method: "POST",
    data: { id: brandId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function likeVehicule(vehiculeId) {
  $.ajax({
    url: "/vscar/api/vehicule/likeVehicule.php",
    method: "POST",
    data: { id: vehiculeId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      location.reload();
    },
  });
}

function unlikeBrandReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/unlikeBrandReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
      location.reload();
    },
  });
}

function deleteVehiculeReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/deleteVehiculeReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function acceptVehiculeReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/acceptVehiculeReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function acceptBrandReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/acceptBrandReview.php",
    method: "POST",
    data: { id: reviewId },
    success: function (result) {
      console.log(result);
      location.reload();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function deleteBrandReview(reviewId) {
  $.ajax({
    url: "/vscar/api/review/deleteBrandReview.php",
    method: "POST",
    data: { id: reviewId },
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

function logout() {
  $.ajax({
    url: "/vscar/api/auth/logout.php",
    method: "POST",
    success: function (result) {
      console.log(result);
      window.location.href = "/vscar";
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

    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener("click", () => {
        nav.classList.toggle("show");
        toggle.classList.toggle("bx-x");
        bodypd.classList.toggle("body-pd");
        headerpd.classList.toggle("body-pd");
      });
    }
  };

  showNavbar("header-toggle", "nav-bar", "body-pd", "header");

  const linkColor = document.querySelectorAll(".nav_link");

  function colorLink() {
    if (linkColor) {
      linkColor.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  }
  linkColor.forEach((l) => l.addEventListener("click", colorLink));

});
