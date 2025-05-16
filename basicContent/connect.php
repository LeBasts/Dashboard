<?php
    require('header.php');
    $error = null;
    if(!empty($_POST['name']) && !empty($_POST['mdp'])){
        if($_POST['name'] === 'bast' && $_POST['mdp'] === "0000"){
            echo 'wowowow;';
            session_start();
            $_SESSION['connected'] = 1;
            header("Location: index.php");
        } else {
            $error = "Identifiants incorrects";
        }
    }
    if($error){
        echo $error;
    }
?>
<form action="" method="post">
    <input type="text" placeholder="Identifiant" name="name">
    <input type="password" placeholder="Mots de passe" name="mdp">
    <button type="submit">Se connecter</button>
</form>
<?php require('footer.php'); ?>