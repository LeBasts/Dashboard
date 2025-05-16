<?php
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'function'.DIRECTORY_SEPARATOR.'auth.php';
session_start();
unset($_SESSION['connected']) ;
header('Location: index.php');