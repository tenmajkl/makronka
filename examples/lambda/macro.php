<?php

use Majkel\Makronka\MacroCollection;

$macros = new MacroCollection();

$macros->macro(
    ['(', T_STRING, T_WHITESPACE, T_VARIABLE, ')', T_WHITESPACE, T_OBJECT_OPERATOR],
    'fn($_1 $_3) =>'
);

return $macros;
