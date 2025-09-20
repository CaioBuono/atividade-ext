<?php

require __DIR__ . '/includes.php';

//TEMPLATE DE RENDERIZAÇÃO HEADER
include TemaLayout::getTemplate('estrutura', 'estrutura-header.tevivo');

//TEMPLATE DA HOME
include TemaLayout::getTemplate('pages/home', 'pages-home.tevivo');

//TEMPLATE DE RENDERIZAÇÃO FOOTER
include TemaLayout::getTemplate('estrutura', 'estrutura-footer.tevivo');
