<?php
declare(strict_types=1);

$input_value = "62343";

$sum = 0;

for ($i = 0; $i < strlen($input_value); $i++) {
    $sum += $input_value[$i];
}

echo $sum;

