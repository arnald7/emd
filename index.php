<?php require_once 'inc/header.php'; ?>

    <h1 class="grey-text text-darken-4">Enter the GitHub Username</h1>

    <form class="row" action="user.php">
        <div class="input-field col s12 m6 offset-m3">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" name="lg" id="icon_prefix">  
            <label for="icon_prefix">Github username</label>
            <div class="center-align">
                <button class="btn" type="submit">Pull User</button>
            </div>
        </div>
    </form>

    <h1 class="grey-text text-darken-4">Or choose any other </h1>

<ul class="gitusers row">
    
    <?php

    if (isset($_GET['c'])) {
        $c = $_GET['c'];
    } else {
        $c = 1;
    }

    $url = "https://api.github.com/users?since=".$c;
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => [
                    'User-Agent: PHP'
            ]
        ]
    ];

    $json = file_get_contents($url, false, stream_context_create($opts));
    $users = json_decode($json);

    foreach($users as $user){

        $lg = $user->login;

        echo '<li class="col s6 m4 l2">';
        echo '<a href="user.php?lg='.$lg.'" class="z-depth-1 hoverable">';
        echo '<img class="z-depth-1" src="'.$user->avatar_url.'" alt="'.$user->login.'">';
        echo '<p>'.$lg.'</p>';
        echo '</a></li>';
    }
    ?>
    
</ul>

<?php require_once 'inc/footer.php'; ?>