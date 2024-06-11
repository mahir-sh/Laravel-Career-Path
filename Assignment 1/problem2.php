<?php


$file = fopen("problem2.txt", "r"); 
$file_character = 1;

while (($c = fgetc($file)) !== false) {
   //echo $c;
   if ($c == ' ' || $c == "\n") {

    $file_character++;
}
}
echo $file_character;
fclose($file);
