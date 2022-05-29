<?php

use Majkel\Makronka\Compiler;
use Majkel\Makronka\MacroCollection;

it('compiles macro', function() {
    $macros = new MacroCollection();
    $macros
        ->macro([269], 'String_::from($_0)');

    $compiler = new Compiler($macros);

    expect($compiler->compile('<?php "foo"->parek();'))
        ->toBe('<?php String_::from("foo")->parek();');
});

it('compiles complex macro', function() {
    $macros = new MacroCollection();
    $macros
        ->macro([T_PUBLIC, T_WHITESPACE, T_STRING, '('], 'public function $_2(');  

    $compiler = new Compiler($macros);

    expect($compiler->compile('<?php class Klobna { public foo() {} }'))
        ->toBe('<?php class Klobna { public function foo() {} }');

    expect($compiler->compile('<?php class Klobna { public foo; }'))
        ->toBe('<?php class Klobna { public foo; }');
});


