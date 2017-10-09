<?php
// récupération de la connexion à la base de données
include_once('../../modele/connexion_sql.php');

// on crée une fonction qui récupère tous les billets de la base de données
function get_billets($offset, $limit)
{
    global $db;
    $offset = (int)$offset;
    $limit = (int)$limit;
    
    $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%imin%ss\') AS heure_crea FROM billets ORDER BY date_creation DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $billets = $req->fetchAll();
    
    return $billets;
}

// on crée une fonction pour ne récupérer qu'un billet en fonction de son id
function get_billet_by_id($id_billet)
{
    global $bdd;
    $id_billet = (int)$id_billet;
    
    $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%imin%ss\') As heure_crea FROM billets WHERE id=:id_billet');
    $req->bindParam(':id_billet', $id_billet, PDO::PARAM_INT);
    $req->execute();
    $billet = $req->fetch();
    
    return $billet;
}
