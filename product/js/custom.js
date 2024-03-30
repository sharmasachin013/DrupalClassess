const container = document.querySelector(".container-view");
const color1 = document.querySelector(".color-1");
const color2 = document.querySelector(".color-2");
const color3 = document.querySelector(".color-3");

color2.addEventListener("click", () => {
  container.classList.add("change");
  container.style.backgroundImage =
    "linear-gradient(to right, rgb(225, 202, 210), rgb(255, 148, 114))";
});

color1.addEventListener("click", () => {
  container.classList.remove("change");
  container.style.backgroundImage =
    "linear-gradient(to right, #b6fbff, #83a4d4)";
});
color3.addEventListener("click", () => {
  container.classList.add("change");
  container.style.backgroundImage =
    "linear-gradient(360deg, #dee1e1 10%, #f4f4f4 360%)";
});
