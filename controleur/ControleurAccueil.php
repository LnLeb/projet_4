<?php

require_once('modele/BilletManager.php');
require_once('modele/CommentaireManager.php');
require_once('vue/Vue.php');

class ControleurAccueil
{
    private $billet;
    private $commentaire;
    private $countBillet;
    private $countComm;
    
    public function __construct()
    {
        $this->billet = new BilletManager;
        $this->commentaire = new CommentaireManager;
    }

    // paramètres d'affichage des billets et des commentaires sur la page d'accueil et sécurisation de l'affichage
    public function accueil()
    {  
        // paramètres d'affichage des billets et des commentaires sur la page d'accueil
        $allBillets = $this->billet->getBillets(0, $this->billet->countBillets());
        $this->countBillet = $this->billet->countBillets() - 3;
        $derniersBillets = $this->billet->getBillets($this->countBillet, 3);
        $this->countComm = $this->commentaire->countCommentairesValide() - 3;
        $derniersCommentaires = $this->commentaire->getCommentairesValide($this->countComm, 3);
        
        // sécurisation de l'affichage
        foreach($derniersBillets as $cle=>$billet)
        {
            $derniersBillets[$cle]['titre'] = htmlspecialchars($billet['titre']);
            $derniersBillets[$cle]['extrait'] = nl2br(htmlspecialchars($billet['extrait']));
        }
        foreach($allBillets as $cle=>$billet)
        {
            $allBillets[$cle]['titre'] = htmlspecialchars($billet['titre']);
        }
        foreach($derniersCommentaires as $cle=>$commentaire)
        {
            $derniersCommentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
            $derniersCommentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
        }
        
        // on génère la vue
        $vue = new Vue('accueil');
        $vue->generer(array('allBillets' => $allBillets, 'derniersBillets' => $derniersBillets, 'derniersCommentaires' => $derniersCommentaires));
    }
}
