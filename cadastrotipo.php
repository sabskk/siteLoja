<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['enviar'])){

    // capturar as variáveis inseridas no HTML
    $nome = $_POST['nome'];

    // variável que guarda o comando SQL pro BD
    $sql = "insert into tipo(nome) values('$nome')";

    // mandar executar comando SQL
    $resultado = mysql_query($sql);

    // analisar resultado
    // AQUI ELE PODE MOSTRAR UM POP UP DE DADOS CADASTRADOS SÓ QUE DIRETO NA PÁGINA INICIAL
    if ($resultado == TRUE){
        echo("Dados gravados com sucesso.");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['alterar'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = "update tipo set nome = '$nome' where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE){
        echo("Dados alterados com sucesso!");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['excluir'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = "delete * from tipo where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE){
        echo("Dados excluídos com sucesso!");
    }
    else{
        echo("Erro. Tente novamente.");
    }
}

if(isset($_POST['pesquisar'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = "select * from tipo where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo "Erro. Tente novamente";
    }
    else{
        echo "<b>"."Pesquisa de Tipo: "."</b><br>";
        
        while ($dados = mysql_fetch_array($resultado)){
                echo "Código: ".$dados['codigo']."<br>"."Nome: ".$dados['nome']."<br>";
            }
    }
}

?>