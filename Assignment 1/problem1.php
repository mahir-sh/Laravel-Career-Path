<?php

declare(strict_types=1);


$minimum_absolute = 100000000;

 $input_data = [10, 12, -15, 189, 22, 2, 34];

for ($i = 0; $i < count($input_data); $i++) {
    if (abs($minimum_absolute) > abs($input_data[$i])) {
        $minimum_absolute = abs($input_data[$i]);
    }
}
echo abs($minimum_absolute);





