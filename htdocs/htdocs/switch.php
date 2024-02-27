<?php
  

  $numero_1 = 20;

  $numero_2 = 10;

    $operador = '+';


    switch($operador){
        case '+':
        echo("A soma de $numero_1 e do $numero_2 é " .$numero_1 + $numero_2);
        break;

        case '-':
            echo("A soma de $numero_1 e do $numero_2 é " .$numero_1 - $numero_2);
        break;

        case '*':
            echo("A soma de $numero_1 e do $numero_2 é " .$numero_1 * $numero_2);
        break;

        case '/':
            echo("A soma de $numero_1 e do $numero_2 é " .$numero_1 / $numero_2);
        break;
                }
?>