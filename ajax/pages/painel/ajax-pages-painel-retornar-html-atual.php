<?php
/**
 * Ajax responsável por retornar textos contidos no HTML com base na sessão que o admin escolher
 *
 * @ajax ajax-pages-painel-retornar-html-atual
 *
 * @author Caio Buono <caio.buono8@gmail.com>
 */

include __DIR__ . '/../../../includes.php';

$retornoSessao = TemaLayout::renderizarArquivoJSON('pages.json', ['pages', $_POST['page']]);

switch ($_POST['page']){
  case 'home-sessao-apresentacao':
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-apresentacao.tevivo');
  break;
  case 'home-sessao-informacoes':
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-informacoes.tevivo');
  break;
  case 'home-sessao-instrutores':
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-instrutores.tevivo');
  break;
  case 'home-sessao-feedbacks':
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-feedbacks.tevivo');
  break;
  case 'home-sessao-placa-selo':
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-placa-selo.tevivo');
  break;
}

echo json_encode([
  'layout' => $varLayout
]);