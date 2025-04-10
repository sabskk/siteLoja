<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['enviar'])){

    // capturar as variáveis inseridas no HTML
    $nome = $_POST['nome'];

    // mandar executar comando SQL
    $sql = mysql_query("insert into categoria(nome) values('$nome')");

    // analisar resultado
    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastrocategoria.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastrocategoria.php';</script>";
    }
}

if(isset($_POST['alterar'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = mysql_query("update categoria set nome = '$nome' where codigo = '$codigo'");

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Dados alterados com sucesso!'); window.location='cadastrocategoria.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastrocategoria.php';</script>";
    }
}

if(isset($_POST['excluir'])){
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    $sql = mysql_query("delete * from categoria where codigo = '$codigo'");

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro escluído com sucesso!'); window.location='cadastrocategoria.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível excluir o cadastro: " . mysql_error() . "'); window.location='cadastrocategoria.php';</script>";
    }
}

if(isset($_POST['pesquisar'])){
    $codigo = $_POST['codigo'];

    $sql = mysql_query("select * from categoria where codigo = '$codigo'");

    if (mysql_affected_rows() > 0){
        echo "<script>alert('Não foi possível encontrar o cadastro: " . mysql_error() . "'); window.location='cadastrocategoria.php';</script>";
    }
    else{
        echo "<b>"."Pesquisa de Categorias: "."</b><br>";
        
        while ($dados = mysql_fetch_array($resultado)){
                echo "Código: ".$dados['codigo']."<br>"."Nome: ".$dados['nome']."<br>";
            }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Cadastrar Categoria </title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    
    <div class="mainarea">

        <div id="menublock">

            <form name="formulario" method="post" action="cadastrocategoria.php">

                <h2> Cadastrar Categoria </h2>
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