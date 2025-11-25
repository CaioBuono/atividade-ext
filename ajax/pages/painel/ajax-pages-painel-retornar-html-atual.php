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

//DEFINE QUAL PÁGINA SERÁ RENDERIZADA E A CLASSE PAI DO TEMA DA SESSÃO
switch ($_POST['page']){
  case 'home-sessao-apresentacao':
    $varClass  = 'boxApresentacao';
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-apresentacao.tevivo');
  break;
  case 'home-sessao-informacoes':
    $varClass  = 'boxInformacoes';
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-informacoes.tevivo');
  break;
  case 'home-sessao-instrutores':
    $varClass  = 'boxInstrutores';
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-instrutores.tevivo');
  break;
  case 'home-sessao-feedbacks':
    $varClass  = 'boxFeedbacks';
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-feedbacks.tevivo');
  break;
  case 'home-sessao-placa-selo':
    $varClass  = 'boxPlacaSelo';
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/home', 'pages-home-placa-selo.tevivo');
  break;
  case 'empresa-sessao-credenciais':
    $varClass = 'boxSessaoImagensPainel';
    $varLayout = TemaLayout::getLayout($retornoSessao, 'pages/empresa', 'pages-empresa-credenciadas.tevivo');
}

echo json_encode([
  'layout' => $varLayout,
  'class'  => $varClass
]);