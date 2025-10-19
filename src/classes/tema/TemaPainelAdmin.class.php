<?php
/**
 * Classe responsável pela manipulação do layout do painel administrativo
 *
 * @class TemaPainelAdmin
 *
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class TemaPainelAdmin{

  /**
   * Propriedade responsável por identificar as páginas existentes no projeto
   * @var array
   */
  private static $pagesExistentes = [
    'home' => 'Pagina inicial',
  ];

  /**
   * Método responsável por retornar as opções de páginas disponíveis para alteração
   * @method getSelectPagesLayout
   * @return string[html]
   */
  public static function getSelectPagesLayout(){
    $retorno['opcoesPagina'] = '<option value="">Selecione uma página</option>';

    foreach(self::$pagesExistentes as $key => $page){
      $varLayout = [
        'value' => $key,
        'nome'  => $page
      ];
      $retorno['opcoesPagina'] .= TemaLayout::getLayout($varLayout, 'pages/painel', 'pages-painel-select-pages-item.tevivo');
    }

    return TemaLayout::getLayout($retorno, 'pages/painel', 'pages-painel-page-home.tevivo');
  }

  /**
   * Método responsável por retornar as opções disponíveis para atualização do layout
   * @method getOpcoesTextoItemLayout
   * @param array $opcoes
   * @return string[html]|null
   */
  public static function getOpcoesSessaoLayout(array $opcoes){
    if(!is_array($opcoes) or empty($opcoes)) return null;

    $retorno = '<option value="">Selecione uma sessão</option>';
    foreach($opcoes as $opcao){
      $varLayout = [
        'value' => $opcao,
        'nome'  => self::getNomeSessao($opcao),
      ];

      $retorno .= TemaLayout::getLayout($varLayout, 'pages/painel', 'pages-painel-select-pages-item.tevivo');
    }

    return $retorno;
  }

  /**
   * Método responsável por retornar o nome da sessão com base na HASH
   * @method getNomeSessao
   * @param string $hash
   * @return string
   */
  public static function getNomeSessao(string $hash){
    $mapNome = [
      'home-sessao-apresentacao' => 'Sessão de apresentação',
      'home-sessao-informacoes'  => 'Sessão de informações',
      'home-sessao-instrutores'  => 'Sessão de instrutores',
      'home-sessao-feedbacks'    => 'Sessão de feedbacks',
      'home-sessao-placa-selo'   => 'Sessão da placa do selo'
    ];

    return $mapNome[$hash];
  }


}