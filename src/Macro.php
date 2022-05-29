<?php

declare(strict_types = 1);

namespace Majkel\Makronka;

use PhpToken;

class Macro
{
    public function __construct(
        private array $tokens,
        private string $compiled,
    )
    {
    }

    public function match(PhpToken $token): ?Macro
    {
        $macro = $this->tokens[sizeof($this->tokens) - 1];
        if ($token->is($macro)) {
            return new Macro(array_slice($this->tokens, 0, -1), $this->compiled);
        }

        return null;
    }

    public function compile(array $tokens): string
    {
        $result = $this->compiled;
        foreach ($tokens as $key => $value) {
            $result = str_replace('$_'.$key, $value->text, $result);
        }

        return $result;
    }

    public function compilable(): bool
    {
        return empty($this->tokens);
    }
}
