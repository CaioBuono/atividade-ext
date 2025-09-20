<?php
/**
 * Classe responsável por definir as configurações do sistema
 * 
 * @class Config
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class Config{

  /**
   * Configurações do sistema
   * @var array
   */
  private static $sistemaConfigs = [
    'sistema/http-ssl'              => false,
    'sistema/server/url'            => 'projeto-bem-estar',
    'sistema/pasta-padrao/template' => ROOT . '/src/tema/template/',
    'sistema/pasta-padrao/layout'   => ROOT . '/src/tema/layout/',
    'sistema/pasta-padrao/image'    => ROOT . '/src/images/',
    'sistema/pasta-padrao/json'     => ROOT . '/src/json-render/'
  ];

  /**
   * Método responsável por iniciar as configurações iniciais do projeto
   * @method init
   * @return void
   */
  public static function init(){
    self::setConstantes();
  }

  /**
   * Método responsável por retornar a config pela flag
   * @method get
   * @param string $config
   * @return string|boolean
   */
  public static function get(string $config){
    return (isset(self::$sistemaConfigs[$config])) ? self::$sistemaConfigs[$config] : null;
  }

  /**
   * Método responsável por setar uma config na sessão do projeto
   * @method set
   * @param string $config
   * @param mixed $value
   * @return void
   */
  public static function set(string $config = "", mixed $value = null){
    $_SESSION[Sessao::getHash()]['config'][$config] = $value;
  }

  /**
   * Método responsável por setar as constantes do sistema
   * @method setConstantes
   * @return void
   */
  public static function setConstantes(){
    define('SSL', self::get('sistema/http-ssl'));
    define('ONLINE', self::isOnline()); //RETORNA SE O PROJETO ESTÁ EM PRODUÇÃO

    define('CAMINHO', self::getProtocoloURL(self::get('sistema/server/url')));  //CAMINHO RAIZ DO PROJETO
    define('CAMINHO_LAYOUT', self::get('sistema/pasta-padrao/layout'));         //CAMINHO DA PASTA DE LAYOUTS
    define('CAMINHO_TEMPLATE', self::get('sistema/pasta-padrao/template'));     //CAMINHO DA PASTA DE TEMPLATE
    define('CAMINHO_IMAGENS', self::get('sistema/pasta-padrao/image'));         // CAMINHO DA PASTA DE IMAGENS
    define('CAMINHO_JSON', self::get('sistema/pasta-padrao/json'));             // CAMINHO DA PASTA DO JSON DE RENDERIZAÇÃO DE LAYOUT
  }

  /**
   * Método responsável por adicionar o protocolo correto a url
   * @method getProtocoloURL
   * @param string $url
   * @return string
   */
  public static function getProtocoloURL(string $url = ""){
    $protocolo = 'http://';
    if(ONLINE and ((isset($_SERVER['SERVER_PORT']) and $_SERVER['SERVER_PORT'] == 443) or SSL)){
      $protocolo = 'https://';
    }

    $url = preg_replace('/^https?:\/\/|\/\//', '', $url);
    return $protocolo . $url;
  }

  /**
   * Método responsável por verificar projeto está em produção ou ambiente de desenvolvimento
   * @method isOnline
   * @return boolean
   */
  public static function isOnline(){
    return (
      (!isset($_SERVER['HTTP_HOST']) or !preg_match('/localhost/', $_SERVER['HTTP_HOST'])) and 
      (!isset($_SERVER['SERVER_NAME']) or !in_array($_SERVER['SERVER_NAME'], ['sebrae-bemestar.php', 'tietevivo-bemestar.php'])) and
      (!isset($_SERVER['SERVER_ADMIN']) or !in_array($_SERVER['SERVER_ADDR'], ['accountmaster@localhost', 'selobemestar@localhost', '[no address given]']))
    );
  }

  
}