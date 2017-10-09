<?php
// on récupère la connexion à la base de données
include_once('../../modele/connexion_sql.php');

//Intégrer de nouveaux articles à la table
$req = $db->prepare('INSERT INTO billets (titre, extrait, contenu, date_creation) VALUES(:titre, :extrait, :contenu, NOW())');
$req->execute(array(
    'titre'=>$_POST['titre'],
    'extrait'=>$_POST['extrait'],
    'contenu'=$_POST['contenu']
));

// on redirige vers la page d'administration du blog
header('Location:../../vue/blog/administration.php');