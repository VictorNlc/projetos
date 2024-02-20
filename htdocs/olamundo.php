<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
Exemplo de arquivo html
<body>

<?php
//primeiro codigo em php
//função echo é para printar/escrever na tela 
    echo("<h1>olá mundo</h1>");

    //declaração de variaveis 

    $nome = "victor natanael";//string


    $idade = 13; //int

    $peso = 77.8;//float


/* status possiveis para a variavel
true siginifica que a aula não acabou 
false - significa que a aula acabou
*/
    $status_aula  = false;//boolean

    $sexo = 'H';




//print de variaveis
    echo("<br>nome:   $nome      <br> idade: $idade   <br>peso:  $peso kg");

//exemplo de if 


/*o if tem tres elementos 
1º variavel a ser testada 
2º operador de comparação(== , != , > , < , =)
3º valor a ser comparado
*/

if ($status_aula == true){


    echo("<br>a aula esta acontecendo");
}else{

    echo("<br>a aula acabou");
}



if ($idade >= 18){
    echo('<br>é maior de idade');
}else{

    echo("<br>é menor de idade");
}
?>

</body>
</html>