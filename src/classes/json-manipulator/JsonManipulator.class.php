<?php
/**
 * Classe responsável por manipular os arquivos JSON do projeto
 *
 * @class JsonManipulator
 *
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class JsonManipulator {

  /**
   * Método responsável por retornar o JSON de todas as sessões da página
   * @method getAllPagesSessao
   * @param string $arquivo
   * @param string $nivel
   * @param string $busca
   * @return array
   */
  public static function getAllPagesSessao(string $arquivo, string $nivel, string $busca){
    if(!strlen($arquivo)) return [];

    $caminho = CAMINHO_JSON . $arquivo;

    $itensLayout = json_decode(file_get_contents($caminho), true);
    if(!isset($itensLayout[$nivel]) or empty($itensLayout[$nivel])) die('JSON de renderização não encontrado!');

    return array_filter(
      array_keys($itensLayout[$nivel]),
      function($itemLayout) use($busca){
        return strpos($itemLayout, $busca) === 0;
      }
    );
  }

  /**
   * Método responsável por retornar as opcoes de sessão de uma página
   * @method getOpcoesSessao
   * @param $allSessoes
   * @param $page
   * @return array
   */
  public static function getOpcoesSessao(array $allSessoes, string $page){
    if(empty($allSessoes)) return [];

    return array_filter(
      $allSessoes,
      function($sessao) use($page){
        if(str_contains($sessao, $page)) return true;
      }
    );
  }

}