<?php
/**
 * Classe responsável por renderizar os arquivos de css e javascript
 * 
 * @class Handler
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class Handler{

  /**
   * Diretório dos arquivos a serem renderizados
   * @var string
   */ 
  protected $nivel = null;

  /**
   * Extensão do arquivo a ser renderizado (css, js)
   * @var string
   */
  protected $tipoArquivo = null;
  
  /**
   * Diretório principal dos arquivos de estilo
   */
  const DIRECTORY_HANDLER_CSS = 'src/tema/estilo/';

  /**
   * Diretório principal dos arquivos de js
   */
  const DIRECTORY_HANDLER_JS = 'src/tema/js/';

  /**
   * Método construtor da classe para definir os nível e o tipo do arquivo a serem renderizados
   * @method __construct
   * @param string $nivel
   * @param string $tipoArquivo
   */
  public function __construct(string $nivel = 'estrutura', string $tipoArquivo = ''){
    if(!strlen($tipoArquivo)) return false;

    $this->setNivel($nivel);
    $this->setTipoArquivo($tipoArquivo);
  }

  /**
   * Método responsável por renderizar os arquivos de css e js no HTML
   * @method getArquivosHandler
   * @return string[html]
   */
  public function getArquivosHandler(){
    switch($this->tipoArquivo){
      case 'css':
        return $this->insertLinkCss(self::DIRECTORY_HANDLER_CSS . $this->nivel);
      case 'js':
        return $this->insertLinkJs(self::DIRECTORY_HANDLER_JS . $this->nivel);
    }
  }

  /**
   * Método responsável por retornar os arquivos dentro de um diretório
   * @method getArquivos
   * @param array $arquivos
   * @return array
   */
  private function getArquivos(array $arquivos){
    $caminho = ($this->tipoArquivo == 'css') ? self::DIRECTORY_HANDLER_CSS . $this->nivel
                                             : self::DIRECTORY_HANDLER_JS . $this->nivel;
    
    return array_values(array_filter(
      $arquivos,
      function($arquivo) use($caminho){
        return is_file($caminho . '/' . $arquivo) and strtolower(pathinfo($arquivo, PATHINFO_EXTENSION)) == $this->tipoArquivo;
      }
    ));
  }

  /**
   * Método responsável por inserir os links dos arquivos css no header do HTML
   * @method insertLinkCss
   * @param string $dir
   * @return string[html]
   */
  private function insertLinkCss(string $dir){
    $headerHtml = null;
    foreach($this->getArquivos(scandir($dir)) as $file){ 
      $headerHtml .= '<link rel="stylesheet" href="' . self::DIRECTORY_HANDLER_CSS . $this->nivel . '/' . $file . '">' . PHP_EOL;
    }
    return $headerHtml;
  }

  /**
   * Método responsável por inserir os links dos arquivos js no header do HTML
   * @method insertLinkJs
   * @param string $dir
   * @return string[html]
   */
  private function insertLinkJs(string $dir){
    $headerJs = null;
    foreach($this->getArquivos(scandir($dir)) as $file){
      $headerJs .= '<script src="' . self::DIRECTORY_HANDLER_JS . $this->nivel . '/' . $file .'" defer></script>' . PHP_EOL;
    }
    return $headerJs;
  }

  /**
   * Método responsável por setar o nível dos arquivos de handler
   * @method setNivel
   * @param string $nivel
   * @return void
   */
  private function setNivel($nivel){
    $this->nivel = $nivel;
  }

  /**
   * Método responsável por setar o tipo do arquivo de handler
   * @method setTipoArquivo
   * @param string $tipoArquivo
   * @return void
   */
  private function setTipoArquivo($tipoArquivo){
    $this->tipoArquivo = $tipoArquivo;
  }


}