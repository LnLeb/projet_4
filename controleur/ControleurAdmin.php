<?php

require_once('modele/BilletManager.php');
require_once('modele/CommentaireManager.php');
require_once('modele/ChapitreManager.php');
require_once('vue/Vue.php');
require_once('modele/Billet.php');
require_once('modele/Chapitre.php');

class ControleurAdmin
{
        private $billet;
        private $commentaire;
        private $chapitre;
    
    public function __construct()
    {
        $this->billet = new BilletManager;
        $this->commentaire = new CommentaireManager;
        $this->chapitre = new ChapitreManager;
    }
    
    // page d'accueil de l'adminitration
    public function admin()
    {
        $billets = $this->billet->getBillets(0, $this->billet->countBillets());
        $chapitres = $this->chapitre->getChapitres(0, $this->chapitre->countChapitres());
        $commentaires = $this->commentaire->getCommentairesAValider(0, $this->commentaire->countCommentairesAValider());

        // on génère la vue
        $vue = new Vue('admin');
        $vue->generer(array('billets' => $billets,
                            'chapitres' => $chapitres,
                            'commentaires' => $commentaires));
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
        $_SESSION['info'] = 'Erreur identifiant ou mot de passe';
        header('Location: index.php?#connexion');
    }
    
    // affiche un chapitre en cours d'écriture pour avoir un apperçu
    public function apercu($id)
    {
        $chapitre = $this->chapitre->getChapitreById($id);
        
        $vue = new Vue('apercu');
        $vue->generer(array('chapitre' => $chapitre));
    }
    
    // affiche la page de mise à jour du chapitre en cours d'écriture
    public function updateChap($id)
    {
        $chapitre = $this->chapitre->getChapitreById($id);
        
        $vue = new Vue('miseAJourChapitre');
        $vue->generer(array('chapitre' => $chapitre));
    }
    
    // mise à jour du chapitre en cours d'écriture
    public function updateChapitre($titre, $extrait, $contenu, $id)
    {
        $this->chapitre->updateChapitre($titre, $extrait, $contenu, $id);
        $_SESSION['info'] = 'Votre chapitre a bien été mis à jour!';
        header('Location: index.php?action=admin');
    }
    
    // suppression du chapitre en cours d'écriture
    public function deleteChapitre($id)
    {
        $this->chapitre->deleteChapitre($id);
        $_SESSION['info'] = 'Le chapitre a été supprimé.';
        header('Location: index.php?action=admin');
    }
    
    // genere la vue du chapitre à publier uniquement pour récupérer les informations et les changer de table
    public function publierChap($id)
    {
        $chapitre = $this->chapitre->getChapitreById($id);
        $vue = new Vue('postBillet');
        $vue->generer(array('chapitre' => $chapitre));
    }
    
    // pour poster un nouveau chapitre dans la BDD
    public function postBillet($id, $titre, $extrait, $contenu)
    {
        $nouvelId = ($this->billet->countBillets() +1);
        $donnees = array('id' => $nouvelId,
                        'titre' => $titre,
                        'extrait' => $extrait,
                        'contenu' => $contenu);
        
        $billet = new Billet($donnees);
        $billet->setId($nouvelId);
        $billet->setTitre($titre);
        $billet->setExtrait($extrait);
        $billet->setContenu($contenu);
        
        $this->billet->postBillet($billet);
        $_SESSION['info'] = 'Votre nouveau chapitre a bien été publié!';
        header('Location: index.php?action=admin#chapitresEnLigne');
    }
    
    public function postChapitre($titre, $extrait, $contenu)
    {
        $donnees = array('titre' => $titre, 
                        'extrait' => $extrait,
                        'contenu' => $contenu);
        
        $chapitre = new Chapitre($donnees);
        $chapitre->setTitre($titre);
        $chapitre->setExtrait($extrait);
        $chapitre->setContenu($contenu);
        
        $this->chapitre->postChapitre($chapitre);
        $_SESSION['info'] = 'Votre chapitre en cours d\'écriture est enregistré';
        header('Location: index.php?action=admin');
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
        $_SESSION['info'] = 'Votre chapitre a bien été mis à jour!';
        header('Location: index.php?action=admin#chapitresEnLigne');
    }
    
    // suppression d'un billet
    public function deleteBillet($id)
    {
        $this->billet->deleteBillet($id);
        $_SESSION['info'] = 'Le chapitre a été supprimé.';
        header('Location: index.php?action=admin');
    }
    
    // validation d'un commentaire signalé
    public function updateCom($id)
    {
        $this->commentaire->updateCommentaire('TRUE', $id);
        $_SESSION['info'] = 'Le commentaire est validé.';
        header('Location: index.php?action=admin#gestionComm');
    }
    
    // suppression d'un commentaire signalé
    public function deleteCom($id)
    {
        $this->commentaire->deleteCommentaire($id);
        $_SESSION['info'] = 'Le commentaire est supprimé.';
        header('Location: index.php?action=admin#gestionComm');
    }
    
    // déconnexion de l'espace admin
    public function deconnexion() 
    {
        session_destroy();
        header('Location: index.php');
    }
}
