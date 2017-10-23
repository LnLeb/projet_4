<?php

require_once('modele/BilletManager.php');
require_once('modele/CommentaireManager.php');
require_once('vue/Vue.php');

class ControleurBillet 
{
    private $billet;
    private $commentaire;
    
    public function __construct()
    {
        $this->billet = new BilletManager();
        $this->commentaire = new CommentaireManager();
    }
    
    public function billet($idBillet)
    {
        // s'il existe un billet correspondant à l'id passé par l'url on récupère uniquement le bon billet pour l'afficher avec les commentaires
        if (isset($_GET['id']))
        {
            $this->billet->getBilletById($_GET['id']);
        }

        // si l'id passé par l'URL ne correspond à aucun billet
        if (empty($billet))
        {
            $billet_vide = true;
        }
        // on demande les commentaires qui correspondent au bon billet
        {
            $commentaires = $this->commentaire->get_commentaires(0, 200);
        }
        
        // s'il existe des commentaires
        if(!empty($commentaires))
        {
            // on sécurise l'affichage
            foreach($commentaires as $cle=>$this->commentaire)
            {
                $commentaires[$cle]['auteur'] = htmlspecialchars($this->commentaire->auteur());
                $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($this->commentaire->commentaire()));
            }
        }
        else
        {
            $commentaire_vide = true;
        }
        
        $vue = new Vue('commentaire');
        $vue->generer(array('billet' => $billet, 'commentaire' => $commentaire));
    }
}   
