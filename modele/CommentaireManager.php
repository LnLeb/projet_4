<?php

require_once 'modele/Modele.php';

class CommentaireManager extends Modele
{
    // Récupération des commentaires
    public function get_commentaires($offset, $limit)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;
        
        $sql = 'SELECT id, id_billet, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y\') AS date_comm, DATE_FORMAT(date_commentaire, \'%Hh%i\') AS heure_comm FROM commentaires ORDER BY date_commentaire LIMIT :offset, :limit';
        $sql->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sql->bindParam(':limit', $limit, PDO::PARAM_INT);
        
        $commentaires = $this->executerRequete($sql, array($offset, $limit));
        return $commentaires->fetchAll();
    }
    
    // Ajout des nouveaux commentaires à la BDD
    public function post_commentaire(Commentaire $commentaire)
    {
        if (isset($_POST['id_billet']))
        {
            $sql = 'INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())';
            
            $sql->bindValue(':id_billet', $commentaire->id_billet());
            $sql->bindValue(':auteur', $commentaire->auteur());
            $sql->bindValue(':commentaire', $commentaire->commentaire());
            
            $this->executerRequete($sql, array('id_billet'=>$_POST['id_billet'],
            'auteur'=>$_POST['auteur'],
            'commentaire'=>$_POST['comm']));
            
            $commentaire->hydrate([
                'id' => $this->bdd->lastInsertId()
            ]);
        }
    }
    
    // Supprimer un commentaire de la BDD
    public function delete_commentaire(Commentaire $commentaire)
    {
        $sql = 'DELETE FROM commentaires WHERE id = '.$commentaire->id();
        $this->executerRequete($sql);
    }
}