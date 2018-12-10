<?php 
require_once 'inc/header.php';
require_once 'inc/functions.php';

dbCon();

if (isset($_POST['action']) && $_POST['action']=="change"){

        $trprc  = $_POST['prc'];
        $trqtd  = $_POST['quantity'];
        $trid   = $_POST['code'];
//        $trvlr  = $_POST['vlr'];
        $trvlr  = $trprc*$trqtd;

    $sql2 = "UPDATE transations SET tr_qtd=$trqtd, tr_vlr=$trvlr WHERE tr_id=$trid";
    mysqli_query($db,$sql2) or die(mysqli_error.' - '.$sql2);
}

    $sql = "SELECT * FROM transations WHERE tr_close != 1";
    $res = mysqli_query($db,$sql);

?>

<div id="cartpage" class="row">

  <div class="card-panel col l12">

        <div class="row">

            <table id="tablecart" class="centered">
                <thead >
                    <tr class="row">
                        <th class="col s3">GitHub User</th>
                        <th class="col s3">Value per hour</th>
                        <th class="col s2">Amount</th>
                        <th class="col s3">Sub-Total</th>
                        <th class="col s1"></th>
                    </tr>                
                </thead>
                <tbody class="body">
                    <?php

                        if(mysqli_num_rows($res) > 0){

                        $total_price = 0;
                        while($inf = mysqli_fetch_array($res)){

                    ?>
                            <tr class="row">
                            <td class="col s3"><?php echo $inf['tr_ghlogin']; ?></td>
                            <td class="col s3 valor"><?php echo valor2($inf['tr_ghlogin']); ?></td>
                            <td class="col s2">

                            <form method="post" action="">

                                <input type="hidden" name="prc" value="<?php echo valor2($inf['tr_ghlogin']); ?>" />
                                <input type="hidden" name="vlr" value="<?php echo valor2($inf['tr_ghlogin'])*$inf['tr_qtd']; ?>" />
                                <input type="hidden" name="code" value="<?php echo $inf['tr_id']; ?>" />
                                <input type="hidden" name="action" value="change" />
                                <select name="quantity" class="qty browser-default" onchange="this.form.submit();">
                                <option <?php if($inf["tr_qtd"]==0) echo "selected";?> value="0">0</option>
                                <option <?php if($inf["tr_qtd"]==1) echo "selected";?> value="1">1</option>
                                <option <?php if($inf["tr_qtd"]==2) echo "selected";?> value="2">2</option>
                                <option <?php if($inf["tr_qtd"]==3) echo "selected";?> value="3">3</option>
                                <option <?php if($inf["tr_qtd"]==4) echo "selected";?> value="4">4</option>
                                <option <?php if($inf["tr_qtd"]==5) echo "selected";?> value="5">5</option>
                                </select>

                            </form>

                            </td>
                            <td class="col s3 amount" name="amount[]"><?php echo valor2($inf['tr_ghlogin'])*$inf['tr_qtd']; ?></td>
                            <td class="col s1">
                                <a href="cart.php?act=del&id=<?php echo $inf['tr_id']; ?>">
                                    <i class="material-icons">delete</i>
                                </a>
                            </td>
                            </tr>

                        <?php
                        /*
                            $ivlr = $inf['tr_vlr'];

                            $total_price += $ivlr;*/
                            }
                        ?>

                        <?php
                        
                    } else {

                        echo '<p class="center-align red-text text-accent-4 red lighten-5"> Carrinho Vazio  </p>';
                    
                    }
                        ?>
                                                     
                </tbody> 
                <tfoot>
                    <tr class="row">
                        <td class="col s3"></td>
                        <td class="col s3"></td>
                        <td class="col s2 right-align">Total:</td>
                        <td class="col s3 center-align total"><?php // echo $total_price; ?>0</td>
                        <td class="col s1"></td>
                    </tr>
                </tfoot>
                   
            </table>

            <div class="row">
                <div class="col s12 m5 offset-m1 left-align">
                    <a href="index.php" class="waves-effect waves-light btn-large">Continue get users</a>
                </div>
                <div class="col s12 m5 right-align">
                    <a href="checkout.php" class="blue darken-4 waves-effect waves-light btn-large">Checkout</a>
                </div>

            </div>
                    
        </div>

    </div>

</div>

<?php 
    dbEnd();
    require_once 'inc/footer.php';
?>