<?php 
require_once('modele/Modele.php');
require_once('modele/Chapitre.php');

class ChapitreManager extends Modele
{
    
    public function getChapitres($offset, $limit)
    {
        $offset = (int)$offset;
        $limit = (int)$limit;
        $sql = 'SELECT id, titre, extrait, contenu FROM chapitres ORDER BY id LIMIT ?, ?';
        
        $req = $this->executerRequete($sql, array($offset, $limit));
        $reponse = $req->fetchAll();
        $chapitres = array();
        foreach ($reponse as $chapitre)
        {
            $chapitre = new Chapitre($chapitre);
            array_push($chapitres, $chapitre);
        }
        return $chapitres;
    }
    
    public function getChapitreById($idBillet)
    {
        $idBillet = (int)$idBillet;
        $sql = 'SELECT id, titre, extrait, contenu FROM chapitres WHERE id=:id_billet';
        
        $req = $this->executerRequete($sql, array($idBillet));
        $chapitre = $req->fetch();
        return $chapitre;
    }
    
    public function postChapitre(Chapitre $chapitre)
    {
        if(isset($_POST['extrait']))
        {
            $sql = 'INSERT INTO chapitres (titre, extrait, contenu) VALUES(?, ?, ?)';
            $array = array($chapitre->titre(), $chapitre->extrait(), $chapitre->contenu());
            $this->executerRequete($sql, $array);
        }
    }
    
    public function deleteChapitre($id)
    {
        $sql = 'DELETE FROM chapitres WHERE id = ?';
        $this->executerRequete($sql, array($id));
    }
    
    public function updateChapitre($titre, $extrait, $contenu, $id)
    {
        $sql = 'UPDATE chapitres SET titre = ?, extrait = ?, contenu = ? WHERE id = ?';
        $array = array($titre, $extrait, $contenu, $id);
        $nouveauChapitre = $this->executerRequete($sql, $array);
        return $nouveauChapitre;
    }
    
    public function countChapitres()
    {
        $sql = 'SELECT COUNT(*) AS nbChapitres FROM chapitres';
        $req = $this->executerRequete($sql);
        $resultat = $req->fetch();
        $nbChapitres = (int)$resultat['nbChapitres'];
        
        return $nbChapitres;
    }
}