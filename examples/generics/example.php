<?php

class Foo
{
    public $bar;

    public function bar<$t>(string $foo): void
    {
        echo $t;
    }

    public function baz(string $baz): string
    {
        $this->bar<Foo>('cs');
    }
}
