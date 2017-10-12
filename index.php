<?php

require('controleur/controleur.php');

try 
{
    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'billet') {
            if (isset($_GET['id'])) {
                $idBillet = intval($_GET['id']);
                if ($idBillet != 0) {
                    billet($idBillet);
                } 
                else {
                    throw new Exception("Identifiant de billet non valide");
                }
            } 
            else {
                throw new Exception("Identifiant de billet non défini");
            }
        } 
        else if ($_GET['action'] == 'admin') {
            admin();
        }
        else {
            throw new Exception("Action non valide");
        }
    }
    else {
        accueil();  // action par défaut
    }
}
catch (Exception $e) {
    erreur($e->getMessage());
}