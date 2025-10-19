<?php
/**
 * Classe responsável pela rendirização dos arquivos de layout do projeto
 *
 * @class TemaLayout
 *
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class TemaLayout{

  /**
   * Método responsável por retornar o caminho do template
   * @method getTemplate
   * @param string $pasta
   * @param string $arquivo
   * @return string
   */
  public static function getTemplate(string $pasta, string $arquivo){
    if(!strlen($pasta) or !strlen($arquivo)) return null;

    $caminho = CAMINHO_TEMPLATE . $pasta . '/' . $arquivo;

    if(!file_exists($caminho)) die('Arquivo de template não encontrado: ' . $caminho);

    return $caminho;
  }

  /**
   * Método responsável por renderizar os arquivos de layout do projeto
   * @method getLayout
   * @param array $variaveis
   * @param string $pasta
   * @param string $arquivo
   * @return string[html]
   */
  public static function getLayout(array $variaveis = [], string $pasta = "", string $arquivo = ""){
    if(!strlen($pasta) or !strlen($arquivo)) return null;

    $caminho = CAMINHO_LAYOUT . $pasta . '/' . $arquivo;

    if(!file_exists($caminho)) die('Arquivo de layout não encontrado: ' . $caminho);

    $conteudoArquivo = file_get_contents($caminho);

    $conteudoArquivo = (!empty($variaveis)) ? self::sobrescreverArquivo($variaveis, $conteudoArquivo)
                                            : $conteudoArquivo;

    return $conteudoArquivo;
  }

  /**
   * Método responsável por sobrescrever as variáveis dos arquivos html
   * @method sobrescreverArquivo
   * @param array $variaveis
   * @param string $conteudo
   * @return string[html]
   */
  private static function sobrescreverArquivo(array $variaveis,  string $conteudo){
    foreach($variaveis as $key => $value){
      $conteudo = str_replace('{{' . $key . '}}', $value, $conteudo);
    }

    return $conteudo;
  }

  /**
   * Método responsável por retornar as variáveis de renderização de layout cadastradas no JSON
   * @method renderizarArquivoJSON
   * @param string $arquivo
   * @param array $mapNivel ["nivel do objeto", "variaveis do objeto"]
   * @return string[html]
   */
  public static function renderizarArquivoJSON(string $arquivo, array $mapNivel){
    if(!strlen($arquivo)) return null;

    $caminho = CAMINHO_JSON . $arquivo;

    $itensLayout =  json_decode(file_get_contents($caminho), true);
    if(!isset($itensLayout[$mapNivel[0]]) or !isset($itensLayout[$mapNivel[0]][$mapNivel[1]])) die('JSON de renderização não encontrado!');

    return $itensLayout[$mapNivel[0]][$mapNivel[1]];
  }

}