const left = document.querySelector(".left");
const right = document.querySelector(".right");
const container = document.querySelector(".container");

$(document).ready(function () {
  $('.alert').addClass('show');
  $('.alert').click(function () {
    $('.alert').alert('close');
  });
});

left.addEventListener("mouseenter", () => {
  container.classList.add("hover-left");
});

left.addEventListener("mouseleave", () => {
  container.classList.remove("hover-left");
});

right.addEventListener("mouseenter", () => {
  container.classList.add("hover-right");
});

right.addEventListener("mouseleave", () => {
  container.classList.remove("hover-right");
});

