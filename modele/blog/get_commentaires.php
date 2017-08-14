<?php
include_once('../../modele/connexion_sql.php');

// fonction pour récupérer les commentaires
function get_commentaires($offset, $limit, $id)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;
    $id = (int) $id;

    $req = $bdd->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%imin%ss\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT :offset, :limit WHERE id_billet = :id');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->bindParam(':id', $id);
    $req->execute();
    $commentaires = $req->fetchAll();

    return $commentaires;
}
