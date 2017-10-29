<?php

require_once('modele/BilletManager.php');
require_once('modele/CommentaireManager.php');
require_once('vue/Vue.php');

class ControleurAccueil
{
    private $billet;
    private $commentaire;
    
    public function __construct()
    {
        $this->billet = new BilletManager;
        $this->commentaire = new CommentaireManager;
    }

    // paramètres d'affichage des billets et des commentaires sur la page d'accueil et sécurisation de l'affichage
    public function accueil()
    {  
        // paramètres d'affichage des billets et des commentaires sur la page d'accueil
        $allBillets = $this->billet->get_billets(0, $this->billet->count_billets());
        $derniersBillets = $this->billet->get_billets($this->billet->count_billets() - 3, 3);
        $derniersCommentaires = $this->commentaire->get_commentaires($this->commentaire->count_commentaires() - 3, 3);
        
        
        // sécurisation de l'affichage
        foreach($derniersBillets as $cle=>$billet)
        {
            $derniersBillets[$cle]['titre'] = htmlspecialchars($billet['titre']);
            $derniersBillets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
        }
        
        $vue = new Vue('accueil');
        $vue->generer(array('allBillets' => $allBillets, 'derniersBillets' => $derniersBillets, 'derniersCommentaires' => $derniersCommentaires));
    }
}
