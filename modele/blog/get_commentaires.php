<?php
// récupération de la connexion à la base de données
include_once('../../modele/connexion_sql.php');

// on crée une fonction qui sert à récupérer les commentaires sur la BDD
function get_commentaires($offet, $limit)
{
    global $db;
    $offset = (int)$offset;
    $limit = (int)$limit;
    
    $req = $db->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%imin%ss\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $commentaires = $req->fetchAll();
    
    return $commentaires;
}
