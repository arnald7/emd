<?php 
require_once 'inc/header.php';
require_once 'inc/functions.php';

dbCon();
/*
$sql = "SELECT * FROM transations";
$res = mysqli_query($db,$sql);
*/

// Botão enviar
if(isset($_POST['btn-entrar'])):
	$erros = array();
	$login = mysqli_escape_string($db, $_POST['login']);
	$senha = mysqli_escape_string($db, $_POST['senha']);

	if(isset($_POST['lembrar-senha'])):

		setcookie('login', $login, time()+3600);
		setcookie('senha', md5($senha), time()+3600);
	endif;

	if(empty($login) or empty($senha)):
		$erros[] = '<p class="red-text text-accent-4 center-align"> Login / password field must be filled in </p>';
	else:
		// 105 OR 1=1 
	    // 1; DROP TABLE teste

		$sql = "SELECT us_login FROM users WHERE us_login = '$login'";
		$resultado = mysqli_query($db, $sql);		

		if(mysqli_num_rows($resultado) > 0):
		$senha = md5($senha);       
		$sql = "SELECT * FROM users WHERE us_login = '$login' AND us_pass = '$senha'";



		$resultado = mysqli_query($db, $sql);

			if(mysqli_num_rows($resultado) == 1):
				$dados = mysqli_fetch_array($resultado);
				mysqli_close($db);
				$_SESSION['logado'] = true;
				$_SESSION['id_usuario'] = $dados['us_id'];
				header('Location: checkout.php');
			else:
				$erros[] = '<p class="red-text text-accent-4 center-align">User and password do not match </p>';
			endif;

		else:
			$erros[] = '<p class="red-text text-accent-4 center-align">User not existent</p>';
		endif;

	endif;

endif;

?>


<div class="row">

    <div class="col s12 m4 offset-m4 z-depth-1 checkout_area">
        <h1 class="grey-text text-darken-4">Login</h1>
            <?php 
            if(!empty($erros)):
                foreach($erros as $erro):
                    echo $erro;
                endforeach;
            endif;
            ?>
           

            <form class="center-align" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                Login: <input type="text" name="login" value="<?php echo isset($_COOKIE['login']) ? $_COOKIE['login'] : '' ?>"><br>
                Senha: <input type="password" name="senha" value="<?php echo isset($_COOKIE['senha']) ? $_COOKIE['senha'] : '' ?>"><br>
                
                <button class="waves-effect waves-light btn-large" type="submit" name="btn-entrar"> Entrar </button>

                <!-- 
                <div class="center-align">
                    <a href="cartlist.php" class="waves-effect waves-light btn-small">
                        <i class="material-icons left">keyboard_backspace</i>Entrar
                    </a>        
                </div> -->

            </form>

           
                   

    </div>



</div>

<?php require_once 'inc/footer.php'; ?>