<?php

// On appelle la classe qui fait la connexion à la BDD et les classes Billet et Commentaire pour récupérer les informations
require_once('modele/Modele.php');
require_once('modele/Billet.php');
require_once('modele/Commentaire.php');

// Création de la classe BilletManager qui effectuera les requêtes en lien avec les billets
class BilletManager extends Modele
{
    // méthode pour récupérer tous les billets
    public function get_billets($offset, $limit)
    {   
        $sql = 'SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') AS heure_crea FROM billets ORDER BY id LIMIT ?, ?';
        $offset = (int)$offset;
        $limit = (int)$limit;
        $req = $this->executerRequete($sql, array($offset, $limit));
        $billets = $req->fetchAll();
        return $billets;
    }
    
    // méthode pour récupérer un seul billet en fonction de son id
    public function getBilletById($id_billet)
    {
        $id_billet = (int)$id_billet;
        
        $sql = 'SELECT id, titre, extrait, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_crea, DATE_FORMAT(date_creation, \'%Hh%i\') As heure_crea FROM billets WHERE id=?';
        $req = $this->executerRequete($sql, array($id_billet));
        
        $billet = $req->fetch();
        return $billet;
    }
    
    // méthode pour poster un nouveau billet dans la BDD
    public function post_billet(Billet $billet) 
    {
        if(isset($_POST['extrait']))
        {
            $sql = 'INSERT INTO billets (titre, extrait, contenu, date_creation) VALUES(?, ?, ?, NOW())';
            $array = array($billet->titre, $billet->extrait, $billet->contenu);
            $this->executerRequete($sql, $array);
        }
    }
    
    // méthode pour supprimer un billet de la BDD
    public function delete_billet(Billet $billet)
    {
        $sql = 'DELETE FROM billets WHERE id = ?';
        $this->executerRequete($sql, array($billet->id));
    }
    
    // méthode pour modifier un billet de la BDD
    public function update_billet(Billet $billet)
    {
        $sql = 'UPDATE billets SET titre = ?, contenu = ?, extrait = ? WHERE id = ?';
        $array = array($billet->titre, $billet->contenu, $billet->extrait, $billet->id);
        $this->executerRequete($sql, $array);
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
