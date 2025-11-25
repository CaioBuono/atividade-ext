<?php

require __DIR__ . '/../includes.php';

//TEMPLATE DE RENDERIZAÇÃO HEADER
include TemaLayout::getTemplate('estrutura', 'estrutura-header.tevivo');

//TEMPLATE DE RENDERIZAÇÃO EMPRESA
include TemaLayout::getTemplate('pages/empresa', 'pages-empresa.tevivo');

//TEMPLATE DE RENDERIZAÇÃO FOOTER
include TemaLayout::getTemplate('estrutura', 'estrutura-footer.tevivo');