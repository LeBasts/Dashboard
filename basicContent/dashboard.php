<?php 
    // On appelle le fichier d'authantification et de fonctions puis le header
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'function'.DIRECTORY_SEPARATOR.'auth.php';
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'function'.DIRECTORY_SEPARATOR.'functionCompteur.php';
    require('header.php');
    // On vérifie si l'utilisateur est connecté
    isConnected();
    // On ajoute 1 vue
    ajouter_vue();
    // On enregistre l'année actuelle dans date
    $date = (int)date('Y');
    // On  l'année selctionné dans selectedYear
    $selectedYear = empty($_GET['year']) ? $date : (int)$_GET['year'];
?>
<div class="sideBar"> 
        <div>
            
            <?php for($i = 0; $i<5 ; $i++): // On boucle depuis l'année actuelle pour afficher les 5 dernières années en mettant la class selected si date = selectedYear?>
            <a class="<?php if($selectedYear === $date - $i){echo "selected";} ?>" href="dashboard.php?year=<?= $date - $i ;?>"><?= $date - $i;?></a>
            <?php show_year($date - $i);endfor; // Appelle la fonction showYear ?>
        </div>
</div>
<div class="content">
    <?php
        // Enregistre dans vu showData et si set alors on affiche le tableau des vues 
        $vues = showData();
        if(isset($vues)):?>
        <table>
            <tr>
                <th>Jour</th>
                <th>Visites</th>
            </tr>
            <?php foreach($vues as $info):?>
            <tr>
                <td><?= $info['jour']; ?></td>
                <td><?= $info['visites']; ?></td>
            </tr>
            <?php endforeach?>
        </table>
    <?php endif; ?>
    <a href="logout.php">Se déconnecter</a>
</div>
<?php require('footer.php'); ?>