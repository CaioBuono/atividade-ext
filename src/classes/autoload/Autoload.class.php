<?php
/**
 * Classe responsável por carregar todas as classes do projeto
 * 
 * @class Autoload
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class Autoload{

  /**
   * Método responsável por carregar o arquivo da classe quando instanciada
   * @method requireAllClassFiles
   * @param string $dir
   * @return string
   */
  public function requireAllClassFiles($dir){
    foreach(scandir($dir) as $entry){
      if($entry == '.' or $entry == '..') continue;

      $path = $dir . DIRECTORY_SEPARATOR . $entry;
      if(is_dir($path)){
        $this->requireAllClassFiles($path);
      }else if(preg_match('/\.class\.php$/', $entry)){
        require_once $path;
      }
    }
  }

}