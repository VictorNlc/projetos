<?php
    $idade = 23;

        $passou_no_teste = true; //aprovado -> aprovado    _____   false ->reprovado

        if ($idade >= 18 && $passou_no_teste == true)
            echo ("apto a tirar cnh");
        else if ($idade <18)
            echo("para estar apto é preciso ser maior de idade");
        else
            echo("para estar apto, é preciso passar no teste psicologico");
?>
