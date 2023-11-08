const slider = document.querySelector(".slider_slide");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");
const slideWidth = document.querySelector(".slide").clientWidth;
let currentIndex = 0;

nextBtn.addEventListener("click", () => {
  if (currentIndex < slider.children.length - 1) {
    currentIndex++;
    translateSlider();
  }
});

prevBtn.addEventListener("click", () => {
  if (currentIndex > 0) {
    currentIndex--;
    translateSlider();
  }
});

function translateSlider() {
  slider.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

