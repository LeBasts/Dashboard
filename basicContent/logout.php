<?php
// Page de déconnexion
// On appelle la page qui contient les fonctions puis on démarre une session
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'function'.DIRECTORY_SEPARATOR.'auth.php';
session_start();
// On reset Session connected
unset($_SESSION['connected']) ;
// On redirige vers index.php 
header('Location: connect.php');