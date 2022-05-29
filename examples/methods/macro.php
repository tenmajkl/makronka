<?php

use Majkel\Makronka\MacroCollection;

$macros = new MacroCollection();

$macros->macro(
    [T_PUBLIC, T_WHITESPACE, T_STRING, '('],
    'public function $_2('
);

return $macros;
