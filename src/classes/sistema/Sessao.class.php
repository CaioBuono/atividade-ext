<?php
/**
 * Classe responsável pela manipulação da sessão do projeto
 * 
 * @class Sessao
 * 
 * @author Caio Buono <caio.buono8@gmail.com>
 */

class Sessao{

  /**
   * Método responsável por retornar a hash única para sessão
   * @method getHash
   * @return string
   */
  public static function getHash(){
    return md5(__DIR__);
  }

}