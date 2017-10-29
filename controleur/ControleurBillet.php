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
            $commentaires = $this->commentaire->get_commentaires_by_id_billet(5 * ($_GET['page'] - 1), 5, $_GET['id']);
            
            // s'il existe des commentaires
            if(!empty($commentaires))
            {
                // on sécurise l'affichage
                foreach($commentaires as $cle=>$commentaire)
                {
                    $commentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
                    $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
                }
            }
        }
        
        $nb_billets = $this->billet->count_billets();
        $nb_pages = ceil(sizeof($commentaires) / 5);
        
        $vue = new Vue('commentaire');
        $vue->generer(array('billet' => $billet, 
                            'commentaires' => $commentaires, 
                            'nb_pages' => $nb_pages, 
                            'nb_billets' => $nb_billets
                           ));
    }
}   
