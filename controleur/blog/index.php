<?php

// on demande les 5 derniers billets au modele
include_once('../../modele/blog/get_billet.php');
$billets = get_billets(0, 5);

// on sécurise l'affichage
foreach($billets as $cle=>$billet)
{
    $billets[$cle]['titre'] = htmlspecialchars($billet['titre']);
    $billets[$cle]['contenu'] = nl2br(htmlspecialchars($billet['contenu']));
}

// on affiche la page via l'index dans la vue
include_once('../../vue/blog/index.php');
