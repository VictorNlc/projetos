<?php
/*
    $horas_trabalhadas = 200;

    $valor_hora = 14;


    echo("voce recebe " . $horas_trabalhadas * $valor_hora);
    */



    $altura = 1.83;
    $sexo = 'M'; 
    
    if($sexo == 'M'){
    echo("seu imc = " . 62.1 * $altura - 44.7 );

    }else{
        echo("seu imc = " . 72.7 * $altura - 58 );
    }




/*

    $num1 = 01; 
    $num2 = 20;
    $num3 = 11;


    if($num1 > $num2 && $num1 > $num3){
        echo("o $num1 é maior que $num2 e $num3");
    }
    else if($num2 > $num1 && $num2 > $num3){
        echo("o $num2 é maior que $num1 e $num3");
    }
    else if($num3 > $num1 && $num3 > $num2){
        echo("o $num3 é maior que $num1 e $num2");
    }
    */


/*
    $nota1 = 11;
    $nota2 = 9.5;
    $nota3 = 8.5;

    $total_nota = 0;
    $soma_nota = 0;


    if($nota1 <= 10 && $nota1 >= 0){
        $total_nota ++ ;
        $soma_nota += $nota1;}
    if($nota2 <= 10 && $nota2 >= 0){
        $total_nota ++ ;
        $soma_nota += $nota2;}
    if($nota3 <= 10 && $nota3 >= 0){
        $total_nota ++ ;
        $soma_nota += $nota3;}
    if($soma_nota > 0){
        $media = $soma_nota / $total_nota;
        echo("a media das notas é :" . $media);
    }

    else{
        echo("nao ha notas validas para calcular");
    }
*/


/*
$massa_corporal = 77;
$altura = 183;
$imc = ($massa_corporal / ($altura * $altura )* 10000);

if($imc < 18.5){
    echo("$imc smilinguido");
}else if ($imc >= 18.5 && $imc < 25){
    echo("$imc : muitor frango");
}else if ($imc >= 25 && $imc < 30){
    echo("$imc : ta malhando é");
}else if ($imc >= 30 && $imc < 35){
    echo("$imc : um monstro");
}
else if ($imc >= 35 && $imc < 40){
    echo("$imc : grodo fudido");
}
else{
    echo("$imc : gordo para caralho");
}

*/

?>