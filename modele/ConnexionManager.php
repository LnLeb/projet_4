<?php
require_once('modele/Modele.php');
require_once('modele/Connexion.php');

class ConnexionManager extends Modele
{
    public function getConnexion()
    {
        $sql = 'SELECT identifiant, motdepasse FROM connexion';
        $req = $this->executerRequete($sql);
        $connexion = $req->fetch();
        return $connexion;
    }
}