/**
 * Script do painel do administrador
 */


/**
 * Função responsável por imprimir o layout na box do HTML do painel
 * @function inserirLayout
 * @param htmlLayout
 */
function inserirLayout(htmlLayout){
  document.getElementById("imprimirLayoutSessao").innerHTML = htmlLayout;
}


/**
 * Realiza uma requisição AJAX ao servidor para retornar as sessões disponíveis com base na página selecionada
 */
document.getElementById("escolherPage").addEventListener("change", async (ev) => {
  const selectPage = ev.target.value;
  inserirLayout("");
  if(selectPage == ""){
    ocultarSelectSessao();
    return;
  }

  const formData = new FormData();
  formData.append("page", selectPage);
  try{
    retorno = await fetch("ajax/pages/painel/ajax-pages-painel-retornar-sessoes.php", {
      method: "POST",
      body: formData
    });

    let response = await retorno.json();
    addOpcoesPagina(response.layout);
    exibirSelectSessao();
  }catch(error){
    console.log("Erro no envio: ", error);
  }

  /**
   * Função responsável por adicionar as OPTIONS ao SELECT de páginas do projeto
   * @function addOpcoesPagina
   * @param htmlOpcoes
   */
  function addOpcoesPagina(htmlOpcoes){
    document.getElementById("pageSessao").innerHTML = htmlOpcoes;
  }

  /**
   * Função responsável por exibir o SELECT de opções da sessão da página
   * @function exibirSelectSessao
   */
  function exibirSelectSessao(){
    document.getElementById("pageSessao").removeAttribute("hidden");
  }

  /**
   * Função responsável por ocultar o SELECT de opções da sessão da página
   * @function ocultarSelectSessao
   */
  function ocultarSelectSessao(){
    document.getElementById("pageSessao").setAttribute("hidden", "hidden");
  }
});

/**
 * Realiza uma requisição no servidor via AJAX e traz o layout da sessão que será modificada no painel
 */
document.getElementById("pageSessao").addEventListener("change", async (ev) => {
  const selectHome = ev.target.value;
  inserirLayout('');
  if(selectHome == "") return;

  const formData = new FormData();
  formData.append("page", selectHome);
  try{
    retorno = await fetch("ajax/pages/painel/ajax-pages-painel-retornar-html-atual.php", {
      method: "POST",
      body: formData
    });

    let response = await retorno.json();
    inserirLayout(response.layout);
    attachInlineEditor(document.querySelector(".boxRenderTextoHome"));
  }catch(error){
    console.error("Erro no envio: ", error)
  }
});














// ------------------- attachInlineEditor -------------------
function attachInlineEditor(root = document) {
  let existingToolbar = document.querySelector('.inline-edit-toolbar');
  if (!existingToolbar) {
    const toolbar = document.createElement('div');
    toolbar.className = 'inline-edit-toolbar';
    toolbar.style.position = 'fixed';
    toolbar.style.zIndex = 9999;
    toolbar.style.display = 'none';
    toolbar.style.padding = '6px';
    toolbar.style.background = '#fff';
    toolbar.style.boxShadow = '0 6px 20px rgba(0,0,0,0.15)';
    toolbar.style.gap = '6px';
    toolbar.style.borderRadius = '6px';
    toolbar.style.alignItems = 'center';

    const btnSave = document.createElement('button'); btnSave.textContent = 'Salvar';
    const btnCancel = document.createElement('button'); btnCancel.textContent = 'Cancelar';
    const status = document.createElement('span');

    toolbar.appendChild(btnSave);
    toolbar.appendChild(btnCancel);
    toolbar.appendChild(status);
    document.body.appendChild(toolbar);

    // salvar referências em dataset pra usar depois
    toolbar._btnSave = btnSave;
    toolbar._btnCancel = btnCancel;
    toolbar._status = status;
  }

  const toolbar = document.querySelector('.inline-edit-toolbar');
  const btnSave = toolbar._btnSave;
  const btnCancel = toolbar._btnCancel;
  const status = toolbar._status;

  let editingEl = null;
  let originalHtml = '';

  function startEditing(el) {
    if (editingEl) cancelEditing();
    editingEl = el;
    originalHtml = el.innerHTML;
    el.contentEditable = "true";
    el.classList.add('editing');
    el.focus();

    const rect = el.getBoundingClientRect();
    const top = window.scrollY + rect.top - 54;
    const left = Math.max(8, rect.left);
    toolbar.style.top = `${top}px`;
    toolbar.style.left = `${left}px`;
    toolbar.style.display = 'flex';
    status.textContent = '';
  }

  function cancelEditing() {
    if (!editingEl) return;
    editingEl.innerHTML = originalHtml;
    stopEditing();
  }

  function stopEditing() {
    if (!editingEl) return;
    editingEl.contentEditable = "false";
    editingEl.classList.remove('editing');
    editingEl = null;
    originalHtml = '';
    toolbar.style.display = 'none';
  }

  function saveEditing() {
    if (!editingEl) return;
    const field = editingEl.dataset.field;
    const allowHtml = editingEl.hasAttribute('data-allow-html');
    const valueToUse = allowHtml ? editingEl.innerHTML : editingEl.textContent;

    // Simulação: só imprime no console (substituir por fetch quando for salvar)
    console.log('SIMULATED SAVE:', { field, value: valueToUse });

    status.textContent = ' Salvo (simulado)';
    setTimeout(() => { status.textContent = ''; }, 900);
    stopEditing();
  }

  // ligar botões (uma vez)
  if (!toolbar._listenersAttached) {
    btnSave.addEventListener('click', (e) => { e.stopPropagation(); saveEditing(); });
    btnCancel.addEventListener('click', (e) => { e.stopPropagation(); cancelEditing(); });
    // clicar fora fecha edição
    document.addEventListener('click', (ev) => {
      if (editingEl && ev.target !== editingEl && !toolbar.contains(ev.target)) {
        cancelEditing();
      }
    });
    //toolbar._listenersAttached = true;
  }

  // attach em todos os elementos data-field dentro do root que ainda não foram ligados
  const nodes = (root === document) ? document.querySelectorAll('[data-field]') : root.querySelectorAll('[data-field]');
  nodes.forEach(el => {
    if (el.dataset.inlineAttached) return; // já ligado
    el.style.cursor = 'pointer';
    el.addEventListener('click', (ev) => {
      ev.stopPropagation();
      startEditing(el);
    });
    el.dataset.inlineAttached = '1';
  });
}
// ------------------- fim attachInlineEditor -------------------
