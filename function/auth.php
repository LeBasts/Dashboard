<?php
    function isConnected():void{
        // Si la session n'est pas lancé on la lance
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        // Si session connected n'est pas renseigné alors on renvoie sur la page de connexion
        if(empty($_SESSION['connected'])){
            header('Location: connect.php');
            exit();
        }
    }


