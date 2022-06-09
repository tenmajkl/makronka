<?php

use Majkel\Makronka\MacroCollection;

$macros = new MacroCollection();

$macros->macro(
    [[T_PRIVATE, T_PROTECTED, T_PUBLIC], T_WHITESPACE, T_STRING, '('],
    '$_0 function $_2('
);

return $macros;
