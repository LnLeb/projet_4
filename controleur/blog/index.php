<?php

// on demande les 5 derniers billets (modele)
include_once('../../modele/blog/get_billets.php');
$billets = get_billets(0,5);

// on effectue du traitement sur les données (contrôleur)
// Ici on doit surtout sécurise l'affichage
foreach($billets as $cle=>$billet)
{
    $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
    $billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
}

// on affiche la page (vue)
include_once('../../vue/blog/index.php');
