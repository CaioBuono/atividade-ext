/**
 * Adiciona eventos de click nos icones das redes sociais
 */
document.addEventListener("DOMContentLoaded", () => {
  const facebookElement = document.getElementById("facebookMedia");
  const linkedinElement = document.getElementById("linkedinMedia");

  facebookElement.addEventListener("click", () => {
    window.open("https://facebook.com", "_blank");
  });

  linkedinElement.addEventListener("click", () => {
    window.open("https://linkedin.com", "_blank");
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const hamburguerButton = document.querySelector(".hamburguer");
  const normalMenu       = document.querySelector(".boxNavegacao");

  hamburguerButton.addEventListener("click", () => {
    hamburguerButton.classList.toggle("active");
    normalMenu.classList.toggle("active");
  });
});