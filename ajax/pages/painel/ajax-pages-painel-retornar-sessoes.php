<?php
/**
 * Ajax responsável por retornar as opções de sessões com base na página escolhida
 *
 * @ajax ajax-pages-painel-retornar-sessoes
 *
 * @author Caio Buono <caio.buono8@gmail.com>
 */
include __DIR__ . '/../../../includes.php';

//RECUPERA TODAS AS SESSOES DISPONÍVEIS NO ARQUIVO JSON
$pagesSessoes = JsonManipulator::getAllPagesSessao('pages.json', 'pages', $_POST['page']);

//RETORNO DAS OPÇÕES DE SESSÃO COM BASE NA PÁGINA ESCOLHIDA
$varLayoutSessoes = TemaPainelAdmin::getOpcoesSessaoLayout($pagesSessoes);

echo json_encode([
  'layout' => $varLayoutSessoes
]);