<?php

// autoload de chargement des classes depuis le dossier contrôleur
function chargerClasse($classe)
{
  require 'controleur/'. $classe . '.php';
}

spl_autoload_register('chargerClasse');


// définition de la classe Routeur qui gère l'affichage des pages en fonction des paramètres transmis par l'url ou affiche des messages d'erreur
class Routeur
{
    private $ctrlAccueil,
            $ctrlBillet,
            $ctrlAdmin,
            $ctrlErreur;
    
    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil;
        $this->ctrlBillet = new ControleurBillet;
        $this->ctrlAdmin = new ControleurAdmin;
        $this->ctrlErreur = new ControleurErreur;
    }
    
    public function routerRequete()
    {
        try 
        {
            // si on tente de définir une action par l'url...
            if (isset($_GET['action']))  
            {
                // si l'action définie est billet : on aura à afficher un chapitre uniquement en fonction de son id
                if ($_GET['action'] == 'billet') 
                {
                    if (isset($_GET['id'])) 
                    {
                        $idBillet = intval($_GET['id']);
                        if ($idBillet != 0) 
                        {
                            $this->ctrlBillet->billet($idBillet);
                            // Si l'action et l'id sont bien définis, on définit la pagination pour les commentaires 
                            if(isset($_GET['page']))
                            {
                                $page = intval($_GET['page']);
                            }
                            // par défaut, la page des commentaires affichée sera la page 1
                            else
                            {
                                $page = intval($_GET['page']);
                                $page = 1;
                            }
                        } 
                        else 
                        {
                            throw new Exception("Identifiant de billet non valide");
                        }
                    } 
                    else 
                    {
                        throw new Exception("Identifiant de billet non défini");
                    }
                } 
                // si l'action définie est admin : on sera sur la page d'administration du site 
                else if ($_GET['action'] == 'admin') {
                    $this->ctrlAdmin->admin();
                }
                // si l'action définie n'est pas valable
                else 
                {
                    throw new Exception("Action non valide");
                }
            }
            // si l'action n'est pas définie : par défaut on sera sur la page d'accueil
            else 
            {
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e) {
            $this->ctrlErreur->erreur($e->getMessage());
        }
    }
}
