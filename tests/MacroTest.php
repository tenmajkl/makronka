<?php

declare(strict_types = 1);

use Majkel\Makronka\Macro;

it('matches macro', function() {
    $macro = new Macro([T_STRING_CAST, '['], 'foo $_2');
    expect($macro = $macro->match(new PhpToken(91, '[')))
        ->toEqual(new Macro([T_STRING_CAST], 'foo $_2'));

    expect($macro->match(new PhpToken(T_AS, 'as')))
        ->toBeNull();

    expect($macro->match(new PhpToken(T_STRING_CAST, 'foo')))
        ->toEqual(new Macro([], 'foo $_2'));
});

it('compiles macro', function() {
    $macro = new Macro([T_STRING_CAST, '['], 'foo $_1'); 

    expect($macro->compile([
        new PhpToken(91, '['),
        new PhpToken(T_STRING_CAST, 'bar'), 
    ]))
        ->toBe('foo bar');
});
