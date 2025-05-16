<?php 
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'function'.DIRECTORY_SEPARATOR.'functionCompteur.php';
ajouter_vue();
$date = (int)date('Y');
$selectedYear = empty($_GET['year']) ? $date : (int)$_GET['year'];
?>
<div class="sideBar"> 
        <div>
            <?php for($i = 0; $i<5 ; $i++):?>
            <a class="<?php if($selectedYear === $date - $i){echo "selected";} ?>" href="index.php?year=<?= $date - $i ;?>"><?= $date - $i;?></a>
            <?php show_year($date - $i);endfor;?>
        </div>
</div>
<div class="content">
    <p>
        <?php
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
    </p>
</div>