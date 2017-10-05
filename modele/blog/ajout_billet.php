<?php
include_once('../../modele/connexion_sql.php');



// Intégrer de nouveaux articles à la table
$req = $bdd->prepare('INSERT INTO billets (titre, contenu, date_creation) VALUES(:titre, :contenu, NOW())');
$req->execute(array(
'titre'=>$_POST['titre'],
'contenu'=>$_POST['contenu']
));

// on redirige vers la page de gestion
header('Location:../../vue/blog/gestion.php');