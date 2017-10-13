<?php
    // récupération de la base de données
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        $msgErreur = $e->getMessage();
        require 'vue/erreur.php';
    }

//Intégrer de nouveaux articles à la table
if(isset($_POST['extrait']))
{
    $req = $db->prepare('INSERT INTO billets (titre, extrait, contenu, date_creation) VALUES(:titre, :extrait, :contenu, NOW())');
    $req->execute(array(
        'titre'=>$_POST['titre'],
        'extrait'=>$_POST['extrait'],
        'contenu'=>$_POST['contenu']
    ));
}

// Intégrer les nouveaux commentaires à la table si l'id du billet correspondant existe
    if (isset($_POST['id_billet']))
    {
        $req = $db->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())');
        $req->execute(array(
            'id_billet'=>$_POST['id_billet'],
            'auteur'=>$_POST['auteur'],
            'commentaire'=>$_POST['comm']
        ));
    }

// on crée une fonction qui récupère tous les billets de la base de données
function get_billets($offset, $limit)
{   
    global $db;
    $offset = (int)$offset;
    $limit = (int)$limit;
    
    $req = $db->prepare('SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') AS heure_crea FROM billets ORDER BY id LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $billets = $req->fetchAll();

    return $billets;
}

function pagination_billets()
{
    global $db;
    
    $req = $db->query('SELECT COUNT(*) AS nb_billets FROM billets');
    $donnees = $req->fetch();
    
    $nb_billets = $donnees['nb_billets'];
    return $nb_billets;
}
    
// on crée une fonction pour ne récupérer qu'un billet en fonction de son id
function get_billet_by_id($id_billet)
{
    global $db;
    $id_billet = (int)$id_billet;
    
    $req = $db->prepare('SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') As heure_crea FROM billets WHERE id=:id_billet');
    $req->bindParam(':id_billet', $id_billet, PDO::PARAM_INT);
    $req->execute();
    $billet = $req->fetch();
    
    return $billet;
}

// on crée une fonction qui sert à récupérer les commentaires sur la BDD
function get_commentaires($offset, $limit)
{
    global $db;
    $offset = (int)$offset;
    $limit = (int)$limit;
    
    $req = $db->prepare('SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $commentaires = $req->fetchAll();
    
    return $commentaires;
}
