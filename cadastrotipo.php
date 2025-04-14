<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['enviar'])){

    // capturar as variáveis inseridas no HTML
    $nome = $_POST['nome'];

    // mandar executar comando SQL
    $sql = mysql_query("insert into tipo(nome) values('$nome')");

    // analisar resultado
    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastrotipo.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastrotipo.php';</script>";
    }
}

if(isset($_POST['alterar'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = mysql_query("update tipo set nome = '$nome' where codigo = '$codigo'");

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Dados alterados com sucesso!'); window.location='cadastrotipo.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastrotipo.php';</script>";
    }
}

if(isset($_POST['excluir'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = mysql_query("delete * from tipo where codigo = '$codigo'");

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro escluído com sucesso!'); window.location='cadastrotipo.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível excluir o cadastro: " . mysql_error() . "'); window.location='cadastrotipo.php';</script>";
    }
}

if(isset($_POST['pesquisar'])){
    $codigo = $_POST['codigo'];

    $sql = "select * from tipo where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_affected_rows() > 0){
        echo "<script>alert('Não foi possível encontrar o cadastro: " . mysql_error() . "'); window.location='cadastrotipo.php';</script>";
    }
    else{
        echo "<b>"."Pesquisa de Tipo: "."</b><br>";
        
        while ($dados = mysql_fetch_array($resultado)){
                echo "Código: ".$dados['codigo']."<br>"."Nome: ".$dados['nome']."<br>";
            }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> Cadastrar Tipo </title>
    <link rel="shortcut icon" href="icon.ico" /> 
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>

        <a href="pesquisa.php" id="logo"><img src="https://www.sportsstore.it/assets/img/logo.png" height=95></a>
        <a href="login.php" id="logologin"><img src="https://img.icons8.com/?size=100&id=9ZgJRZwEc5Yj&format=png&color=FFFFFF" height=45></a>

    </header>
    
    <div class="mainarea">

        <div id="menublock">

            <form name="formulario" method="post" action="cadastrotipo.php">

                <h2> Cadastrar Tipo </h2>
                Código: <input type="text" name="codigo" id="codigo" size="20">
                <br><br>
                Nome: <input type="text" name="nome" id="nome" size="20">
                <br><br>
                <input type="submit" name="enviar" id="enviar" value="Enviar"> 
                <input type="submit" name="alterar" id="alterar" value="Alterar"> 
                <input type="submit" name="excluir" id="excluir" value="Excluir"> 
                <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar"> 
        
            </form>

        </div>

    </div>

</body>

</html>