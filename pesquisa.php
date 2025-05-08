<?php
    $connect = mysql_connect("localhost","root","");
    $db = mysql_select_db("loja");

    session_start();
    $status="";

    if (isset($_POST['codigo']) && $_POST['codigo']!="") {
        $codigo = $_POST['codigo'];
        $resultado = mysql_query("SELECT nome, preco, foto1 FROM produto WHERE codigo = '$codigo'");

        $row = mysql_fetch_assoc($resultado);

        $nome = $row['nome'];
        $preco = $row['preco'];
        $foto1 = $row['foto1'];

        $cartArray = array($codigo=>array('nome'=>$nome,'preco'=>$preco,'quantity'=>1,'foto'=>$foto1));

        if(empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='box'> O produto foi adicionado ao carrinho! </div>";
        }
        else {
            $array_keys = array_keys($_SESSION["shopping_cart"]);

            if(in_array($codigo,$array_keys)) {
                $status = "<div class='box'> Produto já está no carrinho! </div>";
            }
            else {
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                $status = "<div class='box'> Produto foi adicionado ao carrinho! </div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title> Página Inicial </title>
    <link rel="shortcut icon" href="icon.ico" /> 
    <link rel="stylesheet" href="styles.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Special+Gothic&display=swap" rel="stylesheet">
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

    <div style="clear:both;"></div>
        <div class="messagebox" style="margin:10px 0px;">
        <?php echo $status; ?>
    </div>

    <div id="barrapesquisa">

        <form name="formulario" method="post" action="pesquisa.php" id="formpesquisa">

            <!-- pesquisar Categorias -->
            <label>Categorias: </label>
            <select name="categoria">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM categoria");
            while($categorias = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $categorias['codigo']?>">
                        <?php echo $categorias['nome']?></option>
            <?php }
            ?>
            </select>

            <!-- pesquisar Tipo -->
            <label>Tipos: </label>
            <select name="tipo">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM tipo");
            while($tipos = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $tipos['codigo']?>">
                        <?php echo $tipos['nome']?></option>
            <?php }
            ?>
            </select>

            <!-- pesquisar Marcas -->
            <label>Marcas: </label>
            <select name="marca">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM marca");
            while($marcas = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $marcas['codigo']?>">
                        <?php echo $marcas['nome']?></option>
            <?php }
            ?>
            </select>

            <input type="submit" name="pesquisar" value="Pesquisar">

        </form>

    </div>

    <?php
    /* pesquisar produtos qdo carrega a pagina 1vez  */
    $sql_produtos = "SELECT produto.codigo,produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2 FROM produto";                
    $seleciona_produtos = mysql_query($sql_produtos);    

    if (isset($_POST['pesquisar'])) //verifica que a opção marca e modelo foi selecionada ou não
    {
    /* pesquisar produtos qdo pessiona pesquisar */
    $sql_produtos = "SELECT produto.codigo,produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                    FROM produto";
                                        
    $seleciona_produtos = mysql_query($sql_produtos);

    $marca     = (empty($_POST['marca']))? 'null' : $_POST['marca'];
    $categoria = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
    $tipo      = (empty($_POST['tipo']))? 'null' : $_POST['tipo'];

    if (($marca <> 'null') and ($categoria == 'null') and ($tipo == 'null')) //pesquisar Marca escolhida
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca == 'null') and ($categoria <> 'null') and ($tipo == 'null')) //pesquisar Categoria escolhida
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca == 'null') and ($categoria == 'null') and ($tipo <> 'null')) //pesquisar Tipo escolhido
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and tipo.codigo = '$tipo'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca <> 'null') and ($categoria <> 'null') and ($tipo == 'null')) //pesquisar Marca e Categoria escolhidas
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca == 'null') and ($categoria <> 'null') and ($tipo <> 'null')) //pesquisar Categoria e Tipo escolhidos
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and tipo.codigo = '$tipo'
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca <> 'null') and ($categoria == 'null') and ($tipo <> 'null')) //pesquisar Marca e Tipo escolhidos
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'
                                and tipo.codigo = '$tipo'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca <> 'null') and ($categoria <> 'null') and ($tipo <> 'null')) //pesquisar Marca, Categoria e Tipo escolhidos
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'
                                and tipo.codigo = '$tipo'
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }
        }
    
    // mostrar as informações dos produtos 
    if(mysql_num_rows($seleciona_produtos) == 0) {
        echo '<h1> Desculpe, sua busca não retornou resultados. </h1>';
    }
    else {
        echo "<h1> Resultado da pesquisa de Produtos: </h1>";
        while ($dados = mysql_fetch_object($seleciona_produtos)) {
            echo "<form method='post' action='' id='formproducts'>";
            echo "<div id='divresult'>";
                echo "<div id='divprods'>";
                    echo "<input type='hidden' name='codigo' value='{$dados->codigo}'>";
                    echo "<h2> Nome: </h2> <p>".$dados->nome."</p>";
                    echo "<h2> Descrição: </h2> <p>".$dados->descricao."</p>";
                    echo "<h2> Cor: </h2> <p>".$dados->cor."</p>";
                    echo "<h2> Tamanho: </h2> <p>".$dados->tamanho."</p>";
                    echo "<h2> Preço: </h2> <p>R$".$dados->preco."</p>";
                    echo "<button type='submit' class='buy'> Comprar </button>";
                echo "</div>";
                echo "<div id='imgprods'>";
                    echo '<img src="imgbanco/'.$dados->foto1.'" height="250" width="250" />'." ";
                    echo '<img src="imgbanco/'.$dados->foto2.'" height="250" width="250" />'." ";
                echo "</div>";
            echo "</div>";
            echo "</form>";
        }
    }
?>

