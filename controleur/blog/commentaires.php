<?php
// on récupère les données des billets dans le modèle
include_once('../../modele/blog/get_billet.php');

// s'il existe un billet correspondant à l'id passé par l'url on récupère uniquement le bon billet pour l'afficher avec les commentaires
if (isset($_GET['billet']))
{
    $billet = get_billet_by_id($_GET['billet']);
}

// si l'id passé par l'URL ne correspond à aucun billet
if (empty($billet))
{
    $billet_vide = true;
}

// on demande les 10 derniers commentaires qui correspondent au bon billet au modèle
include_once('../../modele/blog/get_commentaire.php');
$commentaires = get_commentaires(0, 10);

// s'il existe bien des commentaires
if (!empty($commentaires))
{
    // on sécurise l'affichage
    foreach($commentaires as $cle=>$commentaire)
    {
        $commentaires[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
        $commentaire[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
    }
}
// sinon
else 
{
    $commentaire_vide = true;
}

// on affiche la page qui est dans la vue
include_once('../../vue/blog/commentaire.php');
