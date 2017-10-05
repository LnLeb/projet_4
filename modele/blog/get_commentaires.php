<?php
include_once('../../modele/connexion_sql.php');

// fonction pour récupérer les commentaires
function get_commentaires($offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;

    $req = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%imin%ss\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $commentaires = $req->fetchAll();

    return $commentaires;
}
if (isset($_POST['id_billet'])) 
{
// Intégrer les nouveaux commentaires à la table
$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())');
$req->execute(array(
'id_billet'=>$_POST['id_billet'],
'auteur'=>$_POST['auteur'],
'commentaire'=>$_POST['comm']
));
}
