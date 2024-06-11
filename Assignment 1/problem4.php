<?php
declare(strict_types= 1);

$n = 5;
for ($i = 1; $i <= $n; $i++) {
    echo str_repeat(' ', $n - $i);
    echo str_repeat('*', $i * 2 - 1) . "\n";
}

