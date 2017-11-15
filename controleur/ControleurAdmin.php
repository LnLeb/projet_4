<?php

require_once('modele/BilletManager.php');
require_once('modele/CommentaireManager.php');
require_once('vue/Vue.php');
require_once('modele/Billet.php');

class ControleurAdmin
{
        private $billet;
        private $commentaire;
    
    public function __construct()
    {
        $this->billet = new BilletManager;
        $this->commentaire = new CommentaireManager;
    }
    
    // page d'accueil de l'adminitration
    public function admin()
    {
        $billets = $this->billet->getBillets(0, $this->billet->countBillets());
        $commentaires = $this->commentaire->getCommentairesAValider(0, $this->commentaire->countCommentairesAValider());
        
        // sécurisation de l'affichage
        foreach($billets as $cle=>$billet)
        {
            $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
        }
        foreach($commentaires as $cle=>$commentaire)
        {
            $commentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
            $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
        }
        
        // on génère la vue
        $vue = new Vue('admin');
        $vue->generer(array('billets' => $billets, 'commentaires' => $commentaires));
    }
    
    // page de création d'un nouveau chapitre
    public function nouveauChapitre()
    {
        $vue = new Vue('nouveauChapitre');
        $vue->generer(array());
    }
    
    // retour à l'acceuil si erreur de mot de passe ou d'identifiant
    public function errConnexion()
    {
        header('Location: index.php?#connexion');
    }
    
    // pour poster un nouveau chapitre dans la BDD
    public function postBillet($titre, $extrait, $contenu)
    {
        $donnees = array('titre' => $titre,
                        'extrait' => $extrait,
                        'contenu' => $contenu);
        
        $billet = new Billet($donnees);
        $billet->setTitre($titre);
        $billet->setExtrait($extrait);
        $billet->setContenu($contenu);
        
        $this->billet->postBillet($billet);
        header('Location: index.php?action=admin#nouveauChapitre');
    }
    
    // pour afficher la page de mise à jour du billet sélectionné
    public function update($id)
    {
        $billet = $this->billet->getBilletById($id);
        
        $vue = new Vue('miseAJour');
        $vue->generer(array('billet' => $billet));
    }
    
    // pour mettre à jour un chapitre déjà posté dans la BDD
    public function updateBillet($titre, $extrait, $contenu, $id)
    {
        $this->billet->updateBillet($titre, $extrait, $contenu, $id);
        header('Location: index.php?action=admin');
    }
    
    // suppression d'un billet
    public function deleteBillet($id)
    {
        $this->billet->deleteBillet($id);
        header('Location: index.php?action=admin');
    }
    
    // validation d'un commentaire signalé
    public function updateCom($id)
    {
        $this->commentaire->updateCommentaire('TRUE', $id);
        header('Location: index.php?action=admin#gestionComm');
    }
    
    // suppression d'un commentaire signalé
    public function deleteCom($id)
    {
        $this->commentaire->deleteCommentaire($id);
        header('Location: index.php?action=admin#gestionComm');
    }
    
    // déconnexion de l'espace admin
    public function deconnexion() 
    {
        if(isset($_SESSION['identifiant'])) 
        {
            session_destroy();
        }
        header('Location: index.php');
    }
}
