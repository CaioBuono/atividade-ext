<?php
/**
 * Arquivo de includes do projeto
 */

//RAIZ PROJETO
define('ROOT', dirname(__FILE__));

require_once ROOT . '/src/classes/autoload/Autoload.class.php';

$obAutoload = new Autoload();
$obAutoload->requireAllClassFiles(ROOT . '/src/classes');

//INICIA CONFIGS DO PROJETO
Config::init();

