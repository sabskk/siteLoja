<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['enviar'])){
    // capturar as variáveis inseridas no HTML
    $nome      = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $cor       = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $cod_marca = $_POST['cod_marca'];
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo = $_POST['cod_tipo'];
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];

    //criar pasta e mover fotos pra ela
    $diretorio = "imgbanco/";

    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    $novo_nome1 = md5(time().$extensao1);
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);

    //mudar nome foto2
    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time().$extensao2);
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);

    // variável que guarda o comando SQL pro BD
    $sql = mysql_query("insert into produto(nome, descricao, cor, tamanho, preco, codmarca, codcategoria, codtipo, foto1, foto2) 
            values('$nome','$descricao', '$cor', '$tamanho', '$preco', '$cod_marca', '$cod_categoria', '$cod_tipo', '$novo_nome1', '$novo_nome2')");
   
    // analisar resultado
    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastroproduto.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.php';</script>";
    }
}

if(isset($_POST['alterar'])){
    $codigo = $_POST['codigo'];
    $preco = $_POST['preco'];

    $sql = "update produto set preco='$preco' where codigo='$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastroproduto.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.php';</script>";
    }
}

if(isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    echo $codigo;

    $sql = mysql_query("delete from produto where codigo = '$codigo'");

    echo $sql;

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro excluído com sucesso!'); window.location='cadastroproduto.php';</script>";
    }
    else {
        echo "<script>alert('Não foi possível excluir o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.php';</script>";
    }
}

if(isset($_POST['pesquisar'])){
    $codigo = $_POST['codigo'];

    $sql = "select * from produto where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo "<script>alert('Não foi possível encontrar o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.php';</script>";
    }
    else{
        echo "<b>"."Pesquisa de Produto: "."</b><br>";
        
        while ($dados = mysql_fetch_object($resultado)){
                echo "Código: ".$dados->codigo."<br>";
                echo "Nome: ".$dados->nome."<br>";
                echo "Descrição: ".$dados->descricao."<br>";
                echo "Cor: ".$dados->cor."<br>";
                echo "Tamanho: ".$dados->tamanho."<br>";
                echo "Preco: ".$dados->preco."<br>";
                echo "Marca: ".$dados->codmarca."<br>";
                echo "Categoria: ".$dados->codcategoria."<br>";
                echo "Tipo: ".$dados->codtipo."<br>";

                echo '<img src="imgbanco/'.$dados->foto1.'"height="200" widht="200" />'." ";
                echo '<img src="imgbanco/'.$dados->foto2.'"height="200" widht="200" />';
            }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
    <title> Cadastrar Produto </title>
    <link rel="shortcut icon" href="icon.ico" /> 
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>

        <a href="pesquisa.php" id="logo"><img src="https://www.sportsstore.it/assets/img/logo.png" height=95></a>
        <a href="login.php" id="logologin"><img src="https://img.icons8.com/?size=100&id=23400&format=png&color=FFFFFF" height=45></a>
        <a href="carrinho.php">
            <img src="https://img.icons8.com/?size=100&id=rMXM_J0hBtPS&format=png&color=FFFFFF" height=45>
            <?php
                if (!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                    echo "<span>$cart_count</span>";
                }
            ?>
        </a>

    </header>
    
    <div class="mainarea">

        <div id="menublock">

            <form name="formulario" method="POST" action="cadastroproduto.php" enctype="multipart/form-data">

                <h2> Cadastrar Produto </h2>
                Código: <input type="text" name="codigo" id="codigo" size="20">
                <br><br>
                Nome: <input type="text" name="nome" id="nome" size="20">
                <br><br>
                Descrição: <input type="text" name="descricao" id="descricao" size="20">
                <br><br>
                Cor: <input type="text" name="cor" id="cor" size="20">
                <br><br>
                Tamanho: <input type="text" name="tamanho" id="tamanho" size="20">
                <br><br>
                Preço: <input type="text" name="preco" id="preco" size="20">
                <br><br>
                Código da Marca: <input type="text" name="cod_marca" id="cod_marca" size="20">
                <br><br>
                Código da Categoria: <input type="text" name="cod_categoria" id="cod_categoria" size="20">
                <br><br>
                Código do Tipo: <input type="text" name="cod_tipo" id="cod_tipo" size="20">
                <br><br>
                Imagem 1: <input type="file" name="foto1" id="foto1" size="20">
                <br><br>
                Imagem 2: <input type="file" name="foto2" id="foto2" size="20">
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