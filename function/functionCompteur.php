<?php
    function ajouter_vue() : void{
        $fichier = dirname(__DIR__).DIRECTORY_SEPARATOR.'Data'.DIRECTORY_SEPARATOR.'compteur';
        $fichierJournalier = $fichier." ".date('Y_m_d');
        incrementCompteur($fichier);
        incrementCompteur($fichierJournalier);
    }
    
    function incrementCompteur(string $fichierToIncrement) : void{
        $compteur = 1;
        if(file_exists($fichierToIncrement)){
            $compteur = (int)file_get_contents($fichierToIncrement);
            $compteur++;
        }
        file_put_contents($fichierToIncrement, $compteur);
    }
    function nombre_vues(){
        $fichier = dirname(__DIR__).DIRECTORY_SEPARATOR.'Data'.DIRECTORY_SEPARATOR.'compteur';
        return file_get_contents($fichier);
    }
    function show_year($date) : void{
        if(isset($_GET['year'])){
            if($_GET['year'] == $date){
                for($m=1;$m<=12;$m++):?>
                    <a class="<?php if(isset($_GET['month'])){if($_GET['month'] == $m){echo "selected";}}?>" href="index.php?year=<?=$_GET['year']."&month=".$m;?>"><?=date('F',mktime(0,0,0,$m));?></a>
                <?php endfor;
            }
        } 
    }
    function showData(){
        $folder = dirname(__DIR__).DIRECTORY_SEPARATOR.'Data';
        $allTimeCompteur = 0;
            foreach(glob("$folder/compteur") as $path){
                $compt = file_get_contents($path);
                $allTimeCompteur += (int)$compt;
            }
            echo "<BR>Vues depuis la création : ".$allTimeCompteur."<br>"; 
        if(isset($_GET['year'])){
            $year = $_GET['year'];
            $yearCompteur = 0;
            foreach(glob("$folder/compteur $year*") as $path){
                $yearCompteur += (int)file_get_contents($path);
                //echo "<br>".$compt;
            }
            echo "<BR>Vues sur l'annee $year : ".$yearCompteur."<br>"; 
        }
        if (isset($year) && isset($_GET['month'])){
            $monthCompteur = 0;
            $month = $_GET['month'];
            $month = str_pad($month,2,'0',STR_PAD_LEFT);
            $period = $year."_".$month;
            $vues = [];
            $fichiers = glob("$folder/compteur $period*");
            foreach($fichiers as $path){
                $monthCompteur += (int)file_get_contents($path);
                $monthDetail = explode('_',basename($path));
                $vues[] = [
                    'jour' => $monthDetail[2],
                    'visites' => (int)file_get_contents($path)
                ]; 
            }
            echo "<br> Vue sur le mois de ".date('F',mktime(0,0,0,$month))." : ".$monthCompteur;
            return $vues;
        }
    }
?>
