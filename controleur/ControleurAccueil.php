<?php

require_once ('modele/BilletManager.php');
require_once ('modele/CommentaireManager.php');
require_once ('vue/Vue.php');

class ControleurAccueil
{
    private $billet;
    private $commentaire;
    
    public function __construct()
    {
        $this->billet = new BilletManager;
        $this->commentaire = new CommentaireManager;
    }

    // 
    public function accueil()
    {  
        $allBillets = $this->billet->get_billets(0, 500);
        $derniersBillets = $this->billet->get_billets($this->billet->count_billets() - 3, 3);
        $derniersCommentaires = $this->commentaire->get_commentaires($this->commentaire->count_commentaires() - 2, 2);
        
        // sécurisation de l'affichage
        foreach($billets as $cle=>$this->billet)
        {
            $billets[$cle]['titre'] = htmlspecialchars($this->billet->titre());
            $billets[$cle]['contenu'] = nl2br(htmlspecialchars($this->billet->contenu()));
        }
        
        $vue = new Vue('accueil');
        $vue->generer(array('billets' => $billets));
    }
}
