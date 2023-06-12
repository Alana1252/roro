window.addEventListener("scroll", function () {
  var navbar = document.querySelector(".navbar");
  var logo = document.querySelector(".logo");

  if (window.pageYOffset > 270) {
    navbar.classList.remove("transparent");
    navbar.classList.add("bg-dark");
    logo.style.width = "30px";
    logo.style.height = "30px";
  } else {
    navbar.classList.remove("bg-dark");
    navbar.classList.add("transparent");
    logo.style.width = "40px";
    logo.style.height = "40px";
  }
});
