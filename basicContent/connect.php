<?php
// Page de connection
    // On appelle le header
    require('header.php');
    // Set error sur null
    $error = null;
    // Signature de mot de passe
    $password = '$2y$12$.wAvgXXhB/P5sBT.0ScmVeOJcdQlvBOWM71iAcW4vzON1YCA9ut92';
    //Si il y a des valeurs dans post name et mdp
    if(!empty($_POST['name']) && !empty($_POST['mdp'])){
        // Si ces valeurs sont = aux mdp et noms user et 0000
        if(htmlspecialchars($_POST['name']) === 'user' && password_verify(htmlspecialchars($_POST['mdp']), $password)){
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
    
?>
<form action="" method="post">
    <input type="text" placeholder="Identifiant (user)" name="name">
    <input type="password" placeholder="Mots de passe (0000)" name="mdp">
    <?php 
    if($error){
        echo "<p>".$error."</p>";
    }
    ?>
    <button type="submit">Se connecter</button>
</form>
<?php require('footer.php'); ?>