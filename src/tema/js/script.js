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

/**
 * Adiciona evento de abrir e fechar a pop-up em telas menores
 */
document.addEventListener("DOMContentLoaded", () => {
  const hamburguerButton = document.querySelector(".hamburguer");
  const popUp            = document.querySelector(".menuPopUp");

  //REMOVE A POP-UP QUANDO CLICA NO HAMBURGUER
  hamburguerButton.addEventListener("click", () => {
    abreFechaPopUp(hamburguerButton, popUp);
  });

  //REMOVE A POP-UP QUANDO CLICA FORA DA TELA
  popUp.addEventListener("click", (e) => {
    if(e.target == popUp){
      popUp.classList.remove("active");
      hamburguerButton.classList.remove("active");
    }
  });
});

/**
 * Abre ou fecha a pop-up caso já esteja ativa
 * @param hamburguerButton
 * @param popUp
 */
function abreFechaPopUp(hamburguerButton, popUp){
  let isActive = hamburguerButton.classList.contains("active");

  if(isActive){
    hamburguerButton.classList.remove("active");
    popUp.classList.remove("active");
    return;
  }

  hamburguerButton.classList.add("active");
  popUp.classList.add("active");
}