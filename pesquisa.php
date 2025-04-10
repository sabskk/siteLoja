<?php
    $connect = mysql_connect("localhost","root","");
    $db = mysql_select_db("loja");
?>

<!DOCTYPE html>
<html>

<head>
    <title> Página Inicial </title>
</head>

<body>

    <form name="formulario" method="post" action="pesquisa.php">

        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/78686393648317.5e69fd9421eff.jpg" width=200 align="left">
        <a href="login.php"> <img src="https://cdn3d.iconscout.com/3d/premium/thumb/login-button-3d-icon-download-in-png-blend-fbx-gltf-file-formats--password-security-account-click-pack-user-interface-icons-10300003.png?f=webp" width=130 align="right"> </a> <br><br>
        <h1>Material Esportivo</h1> <br><br><br><br>
        <h1> Pesquisas: </h1>

        <!-- pesquisar Categorias -->
        <label for="">Categorias: </label>
        <select name="categoria">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT codigo, nome FROM categoria");
        while($categorias = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $categorias['codigo']?>">
                       <?php echo $categorias['nome']   ?></option>
        <?php }
        ?>
        </select>

        <!-- pesquisar Tipo -->
        <label for="">Tipos: </label>
        <select name="tipo">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT codigo, nome FROM tipo");
        while($tipos = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $tipos['codigo']?>">
                       <?php echo $tipos['nome']   ?></option>
        <?php }
        ?>
        </select>

        <!-- pesquisar Marcas -->
        <label for="">Marcas: </label>
        <select name="marca">
        <option value="" selected="selected">Selecione...</option>

        <?php
        $query = mysql_query("SELECT codigo, nome FROM marca");
        while($marcas = mysql_fetch_array($query))
        {?>
        <option value="<?php echo $marcas['codigo']?>">
                       <?php echo $marcas['nome']   ?></option>
        <?php }
        ?>
        </select>

        <input  type="submit" name="pesquisar" value="Pesquisar">

    </form>

    <?php
    /* pesquisar produtos qdo carrega a pagina 1vez  */
    $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2 FROM produto";                
    $seleciona_produtos = mysql_query($sql_produtos);    


    if (isset($_POST['pesquisar'])) //verifica que a opção marca e modelo foi selecionada ou não
    {
    /* pesquisar produtos qdo pessiona pesquisar */
    $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
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
                echo "Resultado da pesquisa de Produtos: <br><br>";
                while ($dados = mysql_fetch_object($seleciona_produtos)) {
                    echo "Nome:".$dados->nome." ";
                    echo "Descrição:".$dados->descricao." ";
                    echo "Cor: ".$dados->cor." ";
                    echo "Tamanho: ".$dados->tamanho." ";
                    echo "Preço R$: ".$dados->preco."<br>";
                    echo '<img src="imgbanco/'.$dados->foto1.'" height="150" width="150" />'." ";
                    echo '<img src="imgbanco/'.$dados->foto2.'" height="150" width="150" />'."<br><br>";
                }
    }
        
        
        
    ?>
    
</body>

</html>