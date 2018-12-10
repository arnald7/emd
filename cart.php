<?php
require_once 'app.php';
require_once 'inc/functions.php';

$lg = pegaGHUser($_GET['lg']);

if ($_GET['act'] == 'add') {


    $ar_lg = array('login'=>$_GET["lg"], 'qtdh'=>0);
  
    array_push($_SESSION['cart'], $ar_lg);

    $ulist = array_unique($_SESSION['cart']);

    $ghlogin = $_GET["lg"];
   
    dbCon();
    $sql = "INSERT INTO transations (tr_ghlogin, tr_data ) VALUES ('$ghlogin', NOW() )";
    mysqli_query($db,$sql) or die(mysqli_error.' - '.$sql);
    dbEnd();

    header('location: cartlist.php');
} 

if ($_GET['act'] == 'del') {

    $trid = $_GET['id'];
/*
    if (!empty($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $select => $val) {
            if($val['login'] == $item_id)
            {
                unset($_SESSION["cart"][$select]);
            }
        }
    }
*/

    dbCon();
//  $sql = "INSERT INTO transations (tr_user, tr_ghlogin, tr_data ) VALUES ('Adm', '$ghlogin', NOW() )";
    $sql = "DELETE FROM transations WHERE tr_id=$trid";
    mysqli_query($db,$sql) or die(mysqli_error.' - '.$sql);
    dbEnd();

    header('location: cartlist.php');
} 

?>

