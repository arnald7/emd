<?php 
require_once 'inc/header.php';
require_once 'inc/functions.php';

// Verificação
if(!isset($_SESSION['logado'])):
	header('Location: login.php');
endif;





dbCon();
$sql = "SELECT * FROM transations";
$res = mysqli_query($db,$sql);
dbEnd();
?>


<div class="row">

    <div class="col s12 m4 offset-m4 teal lighten-4 z-depth-1 checkout_area">
        <h1 class="grey-text text-darken-4">Thank You!</h1>

        <?php
        dbCon();
        $id = $_SESSION['id_usuario'];
        $sql = "SELECT * FROM users WHERE us_id = '$id'";
        $resultado = mysqli_query($db, $sql);
        $dados = mysqli_fetch_array($resultado);
        dbEnd();
        ?>

        <p class="center-align"><?php echo $dados['us_name']; ?></p>        

        <p class="center-align">
            your order has benn placed
        </p>
                 

        <div class="center-align">
            <a href="index.php" class="waves-effect waves-light btn-large">
                <i class="material-icons left">home</i>Return to home
            </a>        
        </div>
        

    </div>

</div>

<?php require_once 'inc/footer.php'; ?>