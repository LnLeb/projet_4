<?php

function chargerClasse($classe)
{
  require 'modele/'. $classe . '.php';
}

spl_autoload_register('chargerClasse');

// Affiche la liste de tous les billets du blog
function accueil() {
    // Elément page pour la pagination des billets
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else {
        $page = 1;
    }
    
    $billets = new BilletManager;
    $billets->get_billets(5*($page - 1), 5);

    // on sécurise l'affichage
    foreach($billets as $cle=>$billet)
    {
        $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
        $billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
    }
    
    $nb_articles = new BilletManager;
    $nb_articles->pagination_billets(); // Connaitre le nombre de resultats
    $nb_pages=ceil($nb_articles/5); // Divisé par le nombre de pages
    
    require('vue/accueil.php');
}

// Affiche le billet
function billet($idBillet) {
    // s'il existe un billet correspondant à l'id passé par l'url on récupère uniquement le bon billet pour l'afficher avec les commentaires
    if (isset($_GET['id']))
    {
        $billet = new BilletManager;
        $billet->getBilletById($_GET['id']);
    }

    // si l'id passé par l'URL ne correspond à aucun billet
    if (empty($billet))
    {
        $billet_vide = true;
    }
    
    // on demande les commentaires qui correspondent au bon billet au modèle
    $commentaires = new CommentaireManager;
    $commentaires->get_commentaires(0, 200);

    // s'il existe bien des commentaires
    if (!empty($commentaires))
    {
        // on sécurise l'affichage
        foreach($commentaires as $cle=>$commentaire)
        {
            $commentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
            $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
        }
    }
    // sinon
    else 
    {
        $commentaire_vide = true;
    }
    require('vue/commentaire.php');
}

// Affiche l'administration
function admin() 
{
    if ((isset($_POST['identifiant']) AND $_POST['identifiant'] == "Jean.Forteroche" AND isset($_POST['motdepasse']) AND $_POST['motdepasse'] == "alaska2.0") OR (isset($_SESSION['identifiant'])))
    {
        $_SESSION['identifiant']=$_POST['identifiant'];
        // on affiche la page (vue)
        require('vue/admin.php');
    }
    else 
    {
        require('vue/accueil.php');
    }
}
// Déconnexion de l'espace admin
function deconnexion() {
    if(isset($_SESSION['identifiant'])) {
    session_destroy(); 
    } 
    require('vue/accueil.php');
}


// Affiche une erreur
function erreur($msgErreur) {
  require('vue/erreur.php');
}
