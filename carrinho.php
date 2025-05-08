<?php
  session_start();
  $status="";

  if (isset($_POST['action']) && $_POST['action']=="remove")
  {
    if(!empty($_SESSION["shopping_cart"])) 
    {
      foreach($_SESSION["shopping_cart"] as $key => $value) 
      {
        if($_POST["codigo"] == $key){
          unset($_SESSION["shopping_cart"][$key]);
          $status = "<div class='box'> Produto foi removido do carrinho! </div>";
        }
        if(empty($_SESSION["shopping_cart"])) {
          unset($_SESSION["shopping_cart"]);
        }
      }
    }
  }

  if (isset($_POST['action']) && $_POST['action']=="change")
  {
    foreach($_SESSION["shopping_cart"] as $value){
      if($value['codigo'] == $_POST["codigo"]){
          $value['quantity'] = $_POST["quantity"];
          break;
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
    
  <div class="cart">
    <?php
      if(isset($_SESSION["shopping_cart"])){
          $total_price = 0;
    ?>

    <table class="table">

      <tbody>

        <tr>
          <td> <h2> Descrição </h2> </td>
          <td> <h2> Quantidade </h2> </td>
          <td> <h2> Preço </h2> </td>
          <td> <h2> Total </h2> </td>
        </tr>

        <?php
          foreach ($_SESSION["shopping_cart"] as $product){
        ?>

            <form method='post' action=''>
              <tr>
              <td>
              <?php echo '<img src="imgbanco/'.$product["foto"].'" height=150 width=150 /> <br>'."  ";
                  echo $product['nome']; ?>
              </td>
              <td>
              <input type='hidden' name='codigo' value="<?php echo $product['codigo'];?>" />
              <input type='hidden' name='action' value="change" />
              <select name='quantity' class='quantity' onChange="this.form.submit()">
                <option <?php if($product["quantity"]==1) echo "selected";?> value="1"> 1 </option>
                <option <?php if($product["quantity"]==2) echo "selected";?> value="2"> 2 </option>
                <option <?php if($product["quantity"]==3) echo "selected";?> value="3"> 3 </option>
                <option <?php if($product["quantity"]==4) echo "selected";?> value="4"> 4 </option>
                <option <?php if($product["quantity"]==5) echo "selected";?> value="5"> 5 </option>
              </select>
              </td>

          <td> <?php echo "R$".$product["preco"];?> </td>
          <td> <?php echo "R$".number_format($product["preco"]*$product["quantity"], 2, ".", ""), PHP_EOL;?> </td>

          <td>
              <input type='hidden' name='codigo' value="<?php echo $product['codigo'];?>" />              
              <input type='hidden' name='action' value="remove" />
              <button type='submit' class='remove'><img src="https://img.icons8.com/?size=100&id=362&format=png&color=FFFFFF" height=20> </button>
            </form>
          </td>

        </tr>

        <?php
          $total_price += ($product["preco"]*$product["quantity"]);
        }
        ?>

        <tr>
          <td colspan="5" align="right">
            <strong> TOTAL: <?php echo "R$".number_format($total_price, 2, ".", ""), PHP_EOL; ?></strong>
          </td>
        </tr>

      </tbody>

    </table>
    
    <?php
    }
    else{
      echo "<h3> Seu carrinho está vazio! </h3>";
    }
    ?>
    </div>

    <div style="clear:both;"></div>

    <div class="message_box" style="margin:10px 0px;">
      <?php echo $status; ?>
    </div>

  </body>
</html>
