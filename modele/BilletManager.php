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
        
        $billets = $this->executerRequete($sql, array($offset, $limit));
    
        return $billets->fetchAll();
    }
    
    // méthode pour récupérer un seul billet en fonction de son id
    public function getBilletById($id_billet)
    {
        $sql = 'SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') As heure_crea FROM billets WHERE id=:id_billet';
        $billet = $this->executerRequete($sql, array($id_billet));

        $sql->bindParam(':id_billet', $id_billet, PDO::PARAM_INT);

        return $billet->fetch();
    }
    
    // méthode pour poster un nouveau billet dans la BDD
    public function post_billet(Billet $billet) 
    {
        if(isset($_POST['extrait']))
        {
            $sql = 'INSERT INTO billets (titre, extrait, contenu, date_creation) VALUES(:titre, :extrait, :contenu, NOW())';
            
            $sql->bindValue(':titre', $billet->titre());
            $sql->bindValue(':extrait', $billet->extrait());
            $sql->bindValue(':contenu', $billet->contenu());
            
            $this->executerRequete($sql, array('titre'=>$_POST['titre'],
            'extrait'=>$_POST['extrait'],
            'contenu'=>$_POST['contenu']));
            
            $billet->hydrate([
                'id' => $this->bdd->lastInsertId()
            ]);
        }
    }
    
    // méthode pour supprimer un billet de la BDD
    public function delete_billet(Billet $billet)
    {
        $sql = 'DELETE FROM billets WHERE id ='.$billet->id();
        $this->executerRequete($sql);
    }
    
    // méthode pour modifier un billet de la BDD
    public function update_billet(Billet $billet)
    {
        $sql = 'UPDATE billets SET titre = :titre, contenu = :contenu, extrait = :extrait WHERE id = :id';
        $sql->bindValue(':titre', $billet->titre(), PDO::PARAM_INT);
        $sql->bindValue(':contenu', $billet->contenu(), PDO::PARAM_INT);
        $sql->bindValue(':extrait', $billet->extrait(), PDO::PARAM_INT);
        $this->executerRequete($sql);
    }
    
    // méthode pour renvoyer le nombre total de billets
    public function count_billets()
    {
        $sql = 'SELECT COUNT(*) AS nb_billets FROM billets';
        
        $donnees = $this->executerRequete($sql);
        $nb_billets = $donnees['nb_billets'];
        return $nb_billets;
    }
}
