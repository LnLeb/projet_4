<?php
// récupération de la connexion à la base de données
include_once('../../modele/connexion_sql.php');

// Intégrer les nouveaux commentaires à la table si l'id du billet correspondant existe
if (isset($POST['id_billet']))
{
    $req = $db->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())');
    $req->execute(array(
    'id_billet'=>$_POST['id_billet'],
    'auteur'=>$_POST['auteur'],
    'commentaire'=>$POST['comm']
    ));
}