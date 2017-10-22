<?php

require_once ('modele/Billet.php');
require_once ('modele/BilletManager.php');

class ControleurAccueil
{
    private $billet;
    
    public function __construct()
    {
        $this->billet = new BilletManager();
    }

    // Affichage des billets
    public function accueil()
    {
        // pour la pagination : si le numéro de page est défini, sinon page 1 par défaut
        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        else 
        {
            $page = 1;
        }
        
        $billets = $this->billet->get_billets(5 * ($page - 1), 5);
        
        // sécurisation de l'affichage
        foreach($billets as $cle=>$this->billet)
        {
            $billets[$cle]['titre'] = htmlspecialchars($this->billet->titre());
            $billets[$cle]['contenu'] = nl2br(htmlspecialchars($this->billet->contenu()));
        }
        
        // pour connaître le nombre de billets
        $nb_articles = new BilletManager;
        $nb_articles->pagination_billets();
        // qu'on divise par 5 pour avoir le nombre de pages à créer
        $nb_pages = ceil($nb_articles/5);
        
        require('vue/accueil.php');
    }
}
