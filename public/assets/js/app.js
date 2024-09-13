document.addEventListener("DOMContentLoaded", function () {
  var navbar = document.querySelector(".navbar");
  var searchButton = document.querySelector(".search");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
      navbar.classList.add("shadow");
      searchButton.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
      navbar.classList.remove("shadow");
      searchButton.classList.remove("scrolled");
    }
  });
});

document.getElementById("searchButton").addEventListener("click", function () {
  var input = document.getElementById("inputContainer");
  var submitButton = document.getElementById("submitButton");
  var searchButton = document.getElementById("searchButton");

  input.classList.remove("d-none"); // Memunculkan input
  submitButton.classList.remove("d-none"); // Memunculkan tombol submit
  searchButton.classList.add("d-none"); // Menghilangkan tombol pencarian
  searchButton.classList.remove("scrolled");
  searchButton.classList.add("scroll");
});
