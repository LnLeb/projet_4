<?php

// On appelle la classe qui fait la connexion à la BDD et les classes Billet et Commentaire pour récupérer les informations
require_once 'modele/Modele.php';
require_once 'modele/Billet.php';
require_once 'modele/Commentaire.php';

// Création de la classe BilletManager qui effectuera les requêtes en lien avec les billets
class BilletManager extends Modele
{
    // méthode pour récupérer tous les billets
    public function get_billets($offset, $limit)
    {       
        $offset = (int)$offset;
        $limit = (int)$limit;
        
        $sql = 'SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') AS heure_crea FROM billets ORDER BY id LIMIT :offset, :limit';
        
        $req = $this->executerRequete($sql, array('offset' => $offset, 'limit' => $limit));
        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->execute();
        
        $billets = $req->fetchAll();
        return $billets;
    }
    
    // méthode pour récupérer un seul billet en fonction de son id
    public function getBilletById($id_billet)
    {
        $id_billet = (int)$id_billet;
        
        $sql = 'SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') As heure_crea FROM billets WHERE id=:id_billet';
        
        $req = $this->executerRequete($sql, array($id_billet));
        $req->bindParam(':id_billet', $id_billet, PDO::PARAM_INT);
        $req->execute();

        $billet = $req->fetch();
        return $billet;
    }
    
    // méthode pour poster un nouveau billet dans la BDD
    public function post_billet(Billet $billet) 
    {
        if(isset($_POST['extrait']))
        {
            $sql = 'INSERT INTO billets (titre, extrait, contenu, date_creation) VALUES(:titre, :extrait, :contenu, NOW())';
            
            $req = $this->executerRequete($sql, array('titre'=>$_POST['titre'],
            'extrait'=>$_POST['extrait'],
            'contenu'=>$_POST['contenu']));
            $req->bindValue(':titre', $billet->titre());
            $req->bindValue(':extrait', $billet->extrait());
            $req->bindValue(':contenu', $billet->contenu());
            
            $req->execute();
            
            $req->hydrate([
                'id' => $this->bdd->lastInsertId()
            ]);
        }
    }
    
    // méthode pour supprimer un billet de la BDD
    public function delete_billet(Billet $billet)
    {
        $sql = 'DELETE FROM billets WHERE id = :id';
        $req = $this->executerRequete($sql, array('id' => $billet->id()));
        $req->bindParam(':id', $billet->id(), PDO::PARAM_INT);
        
        $req->execute();
    }
    
    // méthode pour modifier un billet de la BDD
    public function update_billet(Billet $billet)
    {
        $sql = 'UPDATE billets SET titre = :titre, contenu = :contenu, extrait = :extrait WHERE id = :id';
        $req = $this->executerRequete($sql, array('titre' => $_POST['titre'], 'extrait' => $_POST['extrait'], 'contenu' => $_POST['contenu']));
        $req->bindValue(':titre', $billet->titre(), PDO::PARAM_INT);
        $req->bindValue(':contenu', $billet->contenu(), PDO::PARAM_INT);
        $req->bindValue(':extrait', $billet->extrait(), PDO::PARAM_INT);
        
        $req->execute();
    }
    
    // méthode pour renvoyer le nombre total de billets
    public function count_billets()
    {
        $sql = 'SELECT COUNT(*) AS nb_billets FROM billets';
        $req = $this->executerRequete($sql);
        $resultat = $req->fetch();
        $nb_billets = (int)$resultat['nb_billets'];
        
        return $nb_billets;
    }
}
