<?php

// On appelle la classe qui fait la connexion à la BDD et les classes Billet et Commentaire pour récupérer les informations
require_once('modele/Modele.php');
require_once('modele/Billet.php');
require_once('modele/Commentaire.php');

// Création de la classe CommentaireManager qui effectuera les requêtes en lien avec les commentaires
class CommentaireManager extends Modele
{
    // Récupération des commentaires
    public function get_commentaires($offset, $limit)
    {
        $sql = 'SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT ?, ?';
        $req = $this->executerRequete($sql, array($offset, $limit));
        $commentaires = $req->fetchAll();
        return $commentaires;
    }
    
    public function get_commentaires_by_id_billet($offset, $limit, $id)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;
        $id = (int)$id;
        
        $sql = 'SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_comm FROM commentaires WHERE id_billet=? ORDER BY date_commentaire LIMIT ?, ?';
        $req = $this->executerRequete($sql, array($id, $offset, $limit));
        
        $commentairesById = $req->fetchAll();
        return $commentairesById;
    }
    
    // Ajout des nouveaux commentaires à la BDD
    public function post_commentaire(Commentaire $commentaire)
    {
        if (isset($_POST['id_billet']))
        {
            $sql = 'INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(?, ?, ?, NOW())';
            $array = array($commetaire->id_billet, $commentaire->auteur, $commentaire->commentaire);
            $this->executerRequete($sql, $array);
        }
    }
    
    // Supprimer un commentaire de la BDD
    public function delete_commentaire(Commentaire $commentaire)
    {
        $sql = 'DELETE FROM commentaires WHERE id = ?';
        $this->executerRequete($sql, array($commentaire->id));
    }
    
    // pour retourner le nombre total de commentaires 
    public function count_commentaires()
    {
        $sql = 'SELECT COUNT(*) AS nb_commentaires FROM commentaires';
        $req = $this->executerRequete($sql);
        $resultat = $req->fetch();
        $nb_commentaires = (int)$resultat['nb_commentaires'];
        
        return $nb_commentaires;
    }
}
