<?php

// On appelle la classe qui fait la connexion à la BDD et les classes Billet et Commentaire pour récupérer les informations
require_once 'modele/Modele.php';
require_once 'modele/Billet.php';
require_once 'modele/Commentaire.php';

// Création de la classe CommentaireManager qui effectuera les requêtes en lien avec les commentaires
class CommentaireManager extends Modele
{
    // Récupération des commentaires
    public function get_commentaires($offset, $limit)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;
        
        $sql = 'SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT :offset, :limit';
        
        $req = $this->executerRequete($sql, array('offset' => $offset, 'limit' => $limit));
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        
        $commentaires = $req->fetchAll();
        return $commentaires;
    }
    
    public function get_commentaires_by_id_billet($offset, $limit, $id)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;
        $id = (int)$id;
        
        $sql = 'SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_comm FROM commentaires WHERE id_billet=:id ORDER BY date_commentaire LIMIT :offset, :limit';
        $req = $this->executerRequete($sql, array('offset' => $offset, 'limit' => $limit));
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        
        $commentairesById = $req->fetchAll();
        return $commentairesById;
    }
    
    // Ajout des nouveaux commentaires à la BDD
    public function post_commentaire(Commentaire $commentaire)
    {
        if (isset($_POST['id_billet']))
        {
            $sql = 'INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())';
            
            $req = $this->executerRequete($sql, array('id_billet'=>$_POST['id_billet'],
            'auteur'=>$_POST['auteur'],
            'commentaire'=>$_POST['comm']));
            
            $req->bindValue(':id_billet', $commentaire->id_billet());
            $req->bindValue(':auteur', $commentaire->auteur());
            $req->bindValue(':commentaire', $commentaire->commentaire());
        
            $req->execute();
            
            $commentaire->hydrate([
                'id' => $this->bdd->lastInsertId()
            ]);
        }
    }
    
    // Supprimer un commentaire de la BDD
    public function delete_commentaire(Commentaire $commentaire)
    {
        $sql = 'DELETE FROM commentaires WHERE id = :id';
        $req = $this->executerRequete($sql, array('id' => $commentaire->id()));
        $req->bindParam(':id', $billet->id(), PDO::PARAM_INT);

        $req->execute();
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
