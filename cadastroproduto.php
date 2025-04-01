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
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastroproduto.html';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.html';</script>";
    }
}

if(isset($_POST['alterar'])){
    $codigo = $_POST['codigo'];
    $preco = $_POST['preco'];

    $sql = "update produto set preco='$preco' where codigo='$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro atualizado com sucesso!'); window.location='cadastroproduto.html';</script>";
    }
    else {
        echo "<script>alert('Não foi possível atualizar o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.html';</script>";
    }
}

if(isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    echo $codigo;

    $sql = mysql_query("delete from produto where codigo = '$codigo'");

    echo $sql;

    if (mysql_affected_rows() > 0) {
        echo "<script>alert('Cadastro excluído com sucesso!'); window.location='cadastroproduto.html';</script>";
    }
    else {
        echo "<script>alert('Não foi possível excluir o cadastro: " . mysql_error() . "'); window.location='cadastroproduto.html';</script>";
    }
}

if(isset($_POST['pesquisar'])){
    $codigo = $_POST['codigo'];

    $sql = "select * from produto where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo "Erro. Tente novamente";
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