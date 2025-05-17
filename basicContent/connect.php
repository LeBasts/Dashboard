<?php
// Page de connection
    // On appelle le header
    require('header.php');
    // Set error sur null
    $error = null;
    //Si il y a des valeurs dans post name et mdp
    if(!empty($_POST['name']) && !empty($_POST['mdp'])){
        // Si ces valeurs sont = aux mdp et noms bast et 0000
        if($_POST['name'] === 'bast' && $_POST['mdp'] === "0000"){
            // On démarre la session et met connected = 1 dedans
            session_start();
            $_SESSION['connected'] = 1;
            // On rediririge vers index.php
            header("Location: dashboard.php");
        } else {
            // On set erreur sur id incorrect
            $error = "Identifiants incorrects";
        }
    }
    // Si il y a une erreur l'affiche
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