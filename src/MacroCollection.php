<?php 

declare(strict_types = 1);

namespace Majkel\Makronka;

use PhpToken;

class MacroCollection
{
    public function __construct(
        /** @var array<Macro> */
        private array $macros = []  
    ) {
    }

    public function match(PhpToken $token): ?self
    {
        $macros = array_values(
            array_filter(
                array_map(
                    fn(Macro $item) => $item->match($token),
                    $this->macros
                )
            )
        );

        return $macros ? new self(
            $macros
        ) : null;
    }

    public function macro(array $tokens, string $compiled): static
    {
        $this->macros[] = new Macro(array_reverse($tokens), $compiled);
        return $this;
    }

    public function macros(): array
    {
        return $this->macros;
    }
}
