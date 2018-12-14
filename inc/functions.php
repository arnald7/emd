<?php

/* BANCO DE DADOS LOCAL */
$hostname = "localhost";
$userDB = "root";
$passwordDB = "";
$database = "rent"; 




function dbCon(){

	global $hostname, $userDB, $passwordDB, $database, $db;
	$db = mysqli_connect($hostname, $userDB, $passwordDB, $database ) or die (mysqli_error());

	mysqli_query($db,"SET NAMES 'utf8'");
	mysqli_query($db,'SET character_set_connection=utf8');
	mysqli_query($db,'SET character_set_client=utf8');
	mysqli_query($db,'SET character_set_results=utf8');

	return $db;
}

function dbEnd(){
	$db = dbCon();
	mysqli_close($db);
}



function pegaGHUser($pg_lg){
    // Função verifica a existencia da conteudo na variavel que identifica o login do GitHubUser
    if (isset($pg_lg)) {
        $lg = $pg_lg;
    } else {
        $lg = '';
    }
    return $lg;
}

function ghuserInfos($gbuser){
    $lg = $gbuser;
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

    return $user;
}

function valor2($gbuser){
    // Função determina qual o valor das horas do GitHubUser

    $lg_infos = ghuserInfos($gbuser);
    $pg_follower = $lg_infos->followers;

    if($pg_follower <= 100){
        $valor = 0.50;
        //Quantidade de Follower menor que 100
    }elseif($pg_follower <= 500 ){
        $valor = 0.75;
        //Quantidade de Follower menor que 500 
    }elseif($pg_follower <= 1000 ){
        $valor = 1.00;
        //Quantidade de Follower menor que 1000
    }elseif($pg_follower >= 1001){
        $valor = 1.50;
        //Quantidade de Follower maior que 1001
    }

    return $valor;
}

function valor($pg_follower){
    // Função determina qual o valor das horas do GitHubUser

    if($pg_follower <= 100){
        $valor = 0.50;
        //Quantidade de Follower menor que 100
    }elseif($pg_follower <= 500 ){
        $valor = 0.75;
        //Quantidade de Follower menor que 500 
    }elseif($pg_follower <= 1000 ){
        $valor = 1.00;
        //Quantidade de Follower menor que 1000
    }elseif($pg_follower >= 1001){
        $valor = 1.50;
        //Quantidade de Follower maior que 1001
    }

    return $valor;
}


error_reporting(0);
?>
