<?php
    function isConnected():bool{
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return !empty($_SESSION['connected']);
    }
    function force_user_connect():void{
        if (!isConnected()){
            header('Location: connect.php');
            exit();
        }
    }


