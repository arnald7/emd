<?php 
require_once 'inc/header.php';
require_once 'inc/functions.php';

// Verificação
if(!isset($_SESSION['logado'])):
	header('Location: login.php');
endif;

    dbCon();
//    $sql = "SELECT * FROM transations";
    $sql = "SELECT * FROM transations WHERE tr_close != 1";
    $res = mysqli_query($db,$sql);
    $count = mysqli_num_rows($res);
    dbEnd()
?>


<div class="row">

    <div class="col s12 m4 offset-m4 light-blue lighten-4 z-depth-1 checkout_area">
        <h1 class="grey-text text-darken-4">Checkout</h1>

        <?php
        dbCon();
        $id = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM users WHERE us_id = '$id'";
        $resultado = mysqli_query($db, $sql);
        $dados = mysqli_fetch_array($resultado);
        $sysuser = $dados['us_login'];
        dbEnd();
        ?>

        <p class="center-align">Hello, <?php echo $dados['us_name']; ?></p>

            <table id="tablecart" class="centered">
                <form name="form1" action="" method="post">
                <thead >
                    <tr class="row">
                        <th class="col s6">Github User</th>
                        <th class="col s6">U$</th>
                    </tr>                
                </thead>
                <tbody class="body">
                    <?php
                        $total_price = 0;
                        while($inf = mysqli_fetch_array($res)){
                    ?>
                            <tr class="row">
                            <td class="col s6"><?php echo $inf['tr_ghlogin']; ?></td>
                            <td class="col s6"><?php echo $inf['tr_vlr']; ?></td>
                            </tr>
                    <?php
                        $total_price += $inf['tr_vlr'];
                    ?>
                        <input type="hidden" name="idtr[]" value="<?php echo $inf['tr_id']; ?>" />

                    <?php } ?>                                 
                </tbody> 
            </table>

            <p class="center-align">
                <strong>
                    <?php echo "Total: U$".$total_price; ?>
                </strong>
            </p>
             

        <div class="center-align">
              
            <button class="waves-effect waves-light btn-large" type="submit" name="submit">Place Order</button>

        </form>



<?php

// Check if button name "Submit" is active, do this
if(isset($_POST['submit'])){
    dbCon();
    $idtr = $_POST['idtr'];

    for($i=0;$i<$count;$i++){
        $sql1 = "UPDATE transations SET tr_close=1, tr_user='$sysuser' WHERE tr_id='$idtr[$i]'";
        $result1 = mysqli_query($db, $sql1);
        }
    }

    if($result1){
    header("location:close.php");
    }
    
dbEnd();


?>


<!--
            <a href="close.php" class="blue darken-4 waves-effect waves-light btn-large">
                <i class="material-icons left">shopping_cart</i>Place Order
            </a> 
            
                    -->


        </div>

        <div class="center-align">
            <a href="cartlist.php" class="waves-effect waves-light btn-small">
                <i class="material-icons left">keyboard_backspace</i>Edit Order
            </a>        
        </div>
        

    </div>



</div>

<?php require_once 'inc/footer.php'; ?>