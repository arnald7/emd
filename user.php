<?php 
require_once 'inc/header.php';
require_once 'inc/functions.php';
    
$lg = pegaGHUser($_GET['lg']);

// /users/:username
    $url = "https://api.github.com/users/".$lg;
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => [
                    'User-Agent: PHP'
            ]
        ]
    ];

    $json = file_get_contents($url, false, stream_context_create($opts));
    $user = json_decode($json);

    $off = 0;

    $ulist = $_SESSION['cart'];
  
    if (!empty($_SESSION["cart"])) {

        $superheroes = $_SESSION["cart"];
        foreach ($superheroes as $ukey) {
            $name = $ukey['login'];
        
           if($name == $_GET['lg']){
                $off = 1;
                break;
            } 
        }
    }
?>

<div id="profile" class="row">

  <div class="card-panel col l12">

        <div class="row">
            <div class="col s12 m3 center-align">
                <img class="responsive-img" src="<?php echo $user->avatar_url; ?>" alt="">
            </div>

            <div class="col s12 m6">
                <h1 class="blue-text text-darken-2"><?php echo $user->name; ?></h1>
                <p class="login blue-text text-darken-2">
                    <a target="_blank" href="https://github.com/<?php echo $user->login; ?>">
                        <?php echo $user->login; ?> <i class="tiny material-icons">launch</i> 
                    </a>                    
                </p>
                <p>Followers: <?php echo $user->followers; ?> - Following: <?php echo $user->following; ?></p>
                <p>Repos: <?php echo $user->public_repos; ?></p>

                <?php // Verifica se 'location' esta vazia 
                $loc = $user->location;
                if (!empty($loc)) { ?>

                    <p>Location: <?php echo $loc; ?></p>

                <?php } ?>

                <?php // Verifica se 'bio' esta vazia 
                $bio = $user->bio;
                if (!empty($bio)) { ?>

                    <h2 class="blue-text text-darken-2">Bio:</h2>
                    <p class="bio"><?php echo $bio; ?></p>

                <?php } ?>
                
            </div>

            <div class="col s12 m3">
                <p class="valuehour">Value per hour: U$ <?php echo valor($user->followers);  ?></p>
                <a href="cart.php?act=add&lg=<?php echo $lg; ?>"
                 class="waves-effect waves-light btn-large <?php if ($off == 1) { echo 'disabled'; } ?> ">
                    <i class="material-icons left">shopping_cart</i><?php if ($off == 1) { echo 'Added'; } else { echo 'Added'; } ?>
                </a> 
            </div>

        </div>


    </div>

</div>


<?php require_once 'inc/footer.php'; ?>