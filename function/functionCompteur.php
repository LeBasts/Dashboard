<?php
    function ajouter_vue() : void{
        // On récupère le fichier compteur global ou du jour puis on les incrémentes
        $fichier = dirname(__DIR__).DIRECTORY_SEPARATOR.'Data'.DIRECTORY_SEPARATOR.'compteur';
        $fichierJournalier = $fichier." ".date('Y_m_d');
        incrementCompteur($fichier);
        incrementCompteur($fichierJournalier);
    }
    
    function incrementCompteur(string $fichierToIncrement) : void{
        // Si le fichier existe on prend l'existant et ajoute un sinon on le crée avec 1
        $compteur = 1;
        if(file_exists($fichierToIncrement)){
            $compteur = (int)file_get_contents($fichierToIncrement);
            $compteur++;
        }
        file_put_contents($fichierToIncrement, $compteur);
    }
    function nombre_vues(){
        // Affiche le nombre de vue dans le fichier compteur
        $fichier = dirname(__DIR__).DIRECTORY_SEPARATOR.'Data'.DIRECTORY_SEPARATOR.'compteur';
        return file_get_contents($fichier);
    }
    function show_year($date) : void{
        // Si get year set 
        if(isset($_GET['year'])){
            // Si = date on affiche les mois de l'année selectionnée
            if($_GET['year'] == $date){
                for($m=1;$m<=12;$m++): // si un mois est selectionné on lui ajoute la classe selected?>
                    <a class="<?php if(isset($_GET['month'])){if($_GET['month'] == $m){echo "selected";}}?>" href="dashboard.php?year=<?=$_GET['year']."&month=".$m;?>"><?=date('F',mktime(0,0,0,$m));?></a>
                <?php endfor;
            }
        } 
    }
    function showData(){
        // On récupère le dossier des données
        $folder = dirname(__DIR__).DIRECTORY_SEPARATOR.'Data';
        // On affiche le compteur global
        echo "<BR>Vues depuis la création : ".nombre_vues()."<br>"; 
        // Si une année est choisie on affiche le compteur récapitulatif de l'année
        if(isset($_GET['year'])){
            $year = $_GET['year'];
            $yearCompteur = 0;
            foreach(glob("$folder/compteur $year*") as $path){
                $yearCompteur += (int)file_get_contents($path);
            }
            echo "<BR>Vues sur l'annee $year : ".$yearCompteur."<br>"; 
        }
        // Si un mois est choisi on affiche les compteurs global de l'année et du mois puis quotidiens
        if (isset($year) && isset($_GET['month'])){
            $monthCompteur = 0;
            $month = str_pad($_GET['month'],2,'0',STR_PAD_LEFT);
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
