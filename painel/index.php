<?php

require __DIR__ . '/../includes.php';

//TEMPLATE DE RENDERIZAÇÃO HEADER
include TemaLayout::getTemplate('estrutura', 'estrutura-header.tevivo');

//TEMPLATE DE RENDERIZAÇÃO DO PAINEL
include TemaLayout::getTemplate('pages/painel', 'pages-painel.tevivo');