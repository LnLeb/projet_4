<?php
include_once('../../modele/blog/get_billets.php');
if (isset($_GET['billet']))
{
    $billet = get_billet_by_id($_GET['billet']);
}

if(empty($billet))
{
    $billet_vide = true;
}

// on demande les 5 derniers commentaires qui correspondent au bon billet (modele)
include_once('../../modele/blog/get_commentaires.php');

// on effectue du traitement sur les données (contrôleur)
// Ici on doit surtout sécurise l'affichage
$commentaires = get_commentaires(0, 10);
if (!empty($commentaires)) 
{
foreach($commentaires as $cle=>$commentaire)
{
    $commentairess[$cle]['auteur'] = htmlspecialchars($commentaire['auteur']);
    $commentaires[$cle]['commentaire'] = nl2br(htmlspecialchars($commentaire['commentaire']));
}
}
else
{
    $commentaire_vide = true;
}
// on affiche la page (vue)
include_once('../../vue/blog/commentaires.php');
