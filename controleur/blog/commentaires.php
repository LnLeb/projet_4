<?php

// on demande le billet correspondant à l'id_billet;
include_once('../../modele/blog/get_billets.php');
$billets = get_billets($_GET['billet'], 5);

// on effectue du traitement sur les données (contrôleur)
// Ici on doit surtout sécurise l'affichage
foreach($billets as $cle=>$billet)
{
    $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
    $billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
}

// on demande les 5 derniers commentaires qui correspondent au bon billet (modele)
include_once('../../modele/blog/get_commentaires.php');
$commentaires = get_commentaires(0, 5, $_GET['billet']);

// on effectue du traitement sur les données (contrôleur)
// Ici on doit surtout sécurise l'affichage

foreach($commentaires as $cle=>$commentaire)
{
    $commentairess[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
    $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
}

// on affiche la page (vue)
include_once('../../vue/blog/commentaires.php');
