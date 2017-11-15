<?php

require_once('modele/BilletManager.php');
require_once('modele/CommentaireManager.php');
require_once('modele/Commentaire.php');
require_once('vue/Vue.php');

class ControleurBillet 
{
    private $billet;
    private $commentaire;
    
    public function __construct()
    {
        $this->billet = new BilletManager;
        $this->commentaire = new CommentaireManager;
    }
    
    public function billet($idBillet)
    {
        // s'il existe un billet correspondant à l'id passé par l'url on récupère uniquement le bon billet pour l'afficher avec les commentaires
        if (isset($_GET['id']))
        {
            $billet = $this->billet->getBilletById($_GET['id']);
            // on demande les commentaires qui correspondent au bon billet
            $allCommentaires = $this->commentaire->getCommentairesByIdBillet(0, $this->commentaire->countCommentairesValide(), $_GET['id']);
            // on limite les commentaires à 5 par page pour la pagination
            $commentaires = $this->commentaire->getCommentairesByIdBillet(5 * ($_GET['page'] - 1), 5, $_GET['id']);
            
            // s'il existe des commentaires
            if(!empty($commentaires))
            {
                // on sécurise l'affichage
                foreach($commentaires as $cle=>$commentaire)
                {
                    $commentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
                    $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
                }
                foreach($allCommentaires as $cle=>$commentaire)
                {
                    $allCommentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
                    $allCommentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
                }
            }
        }
        
        // pour la pagination des commentaires
        $nbPages = ceil(sizeof($allCommentaires) / 5);
        $nbBillets = $this->billet->countBillets();
        
        // on génère la vue
        $vue = new Vue('commentaire');
        $vue->generer(array('billet' => $billet, 
                            'commentaires' => $commentaires, 
                            'nbPages' => $nbPages, 
                            'nbBillets' => $nbBillets
                           ));
        
    }
    
    // pour poster un nouveau commentaire
    public function commenter($auteur, $comm, $idBillet)
    {
        $donnees = array('auteur' => $auteur,
                         'commentaire' => $comm,
                         'idBillet' => $idBillet);
    
        $commentaire = new Commentaire($donnees);
        $commentaire->setAuteur($auteur);
        $commentaire->setCommentaire($comm);
        $commentaire->setIdBillet($idBillet);
        
        $this->commentaire->postCommentaire($commentaire);
        header('Location: index.php?action=billet&id='.$idBillet.'&page=1#postComm');
    }
    
    // pour signaler un commentaire 
    public function signalerCom($idCom, $idBillet)
    {
        $this->commentaire->updateCommentaire('FALSE', $idCom);
        header('Location: index.php?action=billet&id='.$idBillet.'&page=1#postComm');
    }
}   
