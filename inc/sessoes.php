<?php
session_start();

if(!isset($_SESSION['cart'])) {
     $_SESSION['cart'] = array();
 }

if(!isset($_SESSION['user'])) { $_SESSION['user'] = 0; }

if(!isset($_SESSION['logado'])) { $_SESSION['logado'] = false; }

?>