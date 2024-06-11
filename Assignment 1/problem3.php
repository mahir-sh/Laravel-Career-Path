<?php

 declare(strict_types= 1);

$input_string = 'I love programming';


function stringrev(string $input_string): string{

    $reverse = " ";
    
    for($i = 0; $i < strlen($input_string); $i++){
        $reverse = $input_string[$i] . $reverse;
    }

    return $reverse;

}

    echo stringrev($input_string);