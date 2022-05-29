<?php

use Majkel\Makronka\MacroCollection;

$macros = new MacroCollection();

$macros->macro(
    [T_FUNCTION, T_WHITESPACE, T_STRING, '<', T_VARIABLE, '>', '('],
    'function $_2(string $_4, '
);

$macros->macro(
    [T_STRING, '<', T_STRING, '>', '('],
    '$_0($_2::class, '
);

return $macros;
