<?php

declare(strict_types = 1);

namespace Majkel\Makronka;

use PhpToken;

class Compiler
{
    public function __construct(
        private MacroCollection $macros
    ) {
        
    }

    public function compile(string $code): string
    {
        $tokens = PhpToken::tokenize($code);
        $curent = [];
        $macros = $this->macros;
        $result = '';
        foreach ($tokens as $token) {
            if ($macros->match($token)) {
                $macros = $macros->match($token);
                if (array_key_exists(0, $macros->macros())) {
                    $curent[] = $token;
                    if ($macros->macros()[0]->compilable()) {
                        $result .= $macros->macros()[0]->compile($curent);
                        $macros = $this->macros;
                        $curent = [];
                    }
                }
            } else {
                if ($curent) {
                    foreach ($curent as $item) {
                        $result .= $item;
                    }
                    if (count($curent) > 1 || !$token->is($curent[0]->text)) {
                        $curent = [];
                        $macros = $this->macros;
                    }
                }
                $result .= $token->text;
            }
        }

        return $result;
    }
}
