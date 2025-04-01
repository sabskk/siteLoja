<?php

// fazer conexão com o banco
$conectar = mysql_connect("localhost","root","");
$banco = mysql_select_db("loja");

// if para a opção dos botões
if(isset($_POST['enviar'])){

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT login, senha from usuario WHERE login = '$login' and senha = '$senha'";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0){
        echo"<script language='javascript' type='text/javascript'>
                alert('Login ou Senha incorretos.');
                window.location.href='login.html'; 
             </script>'";
    }
    else{
        setcookie('login',$login);
        header('Location:menu.html');
    }

}

?>