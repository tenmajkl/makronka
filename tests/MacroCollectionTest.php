<?php

use Majkel\Makronka\Macro;
use Majkel\Makronka\MacroCollection;

it('filters macro', function() {
    $macros = new MacroCollection();
    $macros
        ->macro(['[', T_STRING_CAST], 'foo $1')
        ->macro([T_VARIABLE], 'var $1');

    expect($macros->match(new PhpToken(91, '[')))
        ->toEqual(new MacroCollection([new Macro([T_STRING_CAST], 'foo $1')]));

    expect($macros->match(new PhpToken(T_VARIABLE, 'klobasa')))
        ->toEqual(new MacroCollection([new Macro([], 'var $1')]));
});

it('filters similar', function() {
    $macros = new MacroCollection();
    $macros
        ->macro(['[', T_STRING_CAST], 'foo $1')
        ->macro([T_VARIABLE], 'var $1')
        ->macro(['[', T_INT_CAST], 'bar $1');

    expect($macros->match(new PhpToken(91, '[')))
        ->toEqual(new MacroCollection([new Macro([T_STRING_CAST], 'foo $1'), new Macro([T_INT_CAST], 'bar $1')]));
});

it('filter none', function() {
    $macros = new MacroCollection();
    $macros
        ->macro([T_STRING_CAST], 'foo $1');

    expect($macros->match(new PhpToken(91, '[')))
        ->toBeNull();
});
