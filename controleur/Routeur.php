<?php

// autoload de chargement des classes

function chargerClasse($classe)
{
  require 'controleur/'. $classe . '.php';
}

spl_autoload_register('chargerClasse');

class Routeur
{
    private $ctrlAccueil,
            $ctrlBillet,
            $ctrlAdmin,
            $ctrlErreur;
    
    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
        $this->ctrlAdmin = new ControleurAdmin();
        $this->ctrlErreur = new ControleurErreur();
    }
    
    public function routerRequete()
    {
        try 
        {
            if (isset($_GET['action']))  {
                if ($_GET['action'] == 'billet') {
                    if (isset($_GET['id'])) {
                        $idBillet = intval($_GET['id']);
                        if ($idBillet != 0) {
                            $this->ctrlBillet->billet($idBillet);
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
                    $this->ctrlAdmin->admin();
                }
                else {
                    throw new Exception("Action non valide");
                }
            }
            else {
                $this->ctrlAccueil->accueil();  // action par défaut
            }
        }
        catch (Exception $e) {
            $this->ctrlErreur->erreur($e->getMessage());
        }
    }
}
