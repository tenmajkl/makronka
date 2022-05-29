<?php

// lets do some declarative prograaming, shall we?

array_map((int $item) -> $item + 1, range(1, 100));

$add = (int $first) -> (int $second) -> $first + $second;

$add(1)(2);
