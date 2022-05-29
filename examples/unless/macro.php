<?php

use Majkel\Makronka\MacroCollection;

$macros = new MacroCollection();

$macros->macro(
    ['unless', T_WHITESPACE, '('],
    'if (!'
);

return $macros;
